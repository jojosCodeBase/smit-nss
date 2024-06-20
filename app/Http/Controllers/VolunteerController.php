<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Courses;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Exports\VolunteersExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VolunteerController extends Controller
{
    public function manage()
    {
        return view('admin.volunteers.manage');
    }
    public function add()
    {
        // 'user' is authenticated to add volunteers
        $courses = Courses::all();
        $batches = Batch::all();
        if (Auth::user()->role == 2)
            return view('user.volunteers.add', ['batches' => $batches, 'courses' => $courses]);
        else
            return view('admin.volunteers.add', ['batches' => $batches, 'courses' => $courses]);
    }
    public function search()
    {
        // 'user' is authenticated to search volunteers
        if (Auth::user()->role == 2)
            return view('user.volunteers.search');
        else
            return view('admin.volunteers.search');

    }
    public function viewEdit()
    {
        // 'user' is not authenticated to edit volunteers
        $volunteers = Volunteer::orderBy('created_at', 'desc')->paginate(10);
        foreach ($volunteers as $v) {
            $v['course'] = $this->courseId_To_courseName($v['course']);
            $v['batch'] = Batch::where('id', $v['batch'])->pluck('name')->first();
        }

        $courses = Courses::all();
        $batches = Batch::all();

        return view('admin.volunteers.view-edit', compact('volunteers', 'courses', 'batches'));
    }
    public function list()
    {
        // 'user' is not authenticated to edit volunteers
        return view('volunteers.list');
    }

    public function delete(Request $r)
    {
        $delete = Volunteer::where('id', $r->regno)->delete();
        if ($delete) {
            return back()->with('success', 'Volunteer deleted successfully !');
        } else {
            return back()->with('error', 'Some error occured in deleting volunteer');
        }
    }
    public function viewUpdate($regno)
    {
        // 'user' is not authenticated to update volunteers
        $volunteer = Volunteer::where('id', $regno)->get();
        foreach ($volunteer as $v) {
            $v['course'] = $this->courseId_To_courseName($v['course']);
        }
        return redirect()->route('volunteer.view-edit')->with(['volunteer' => $volunteer, 'success' => 'Volunteer details updated successfully !']);
    }

    public function insert(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:50',
            'regno' => 'required|numeric|unique:volunteers,regno|max:999999999',
            'email' => 'required|email|unique:volunteers,email',
            'gender' => 'required|string|max:2',
            'phone' => 'required|numeric|max:9999999999',
            'dob' => 'required|date',
            'batch' => 'required|numeric|max:99',
            'course' => 'required|numeric|max:99',
            'nationality' => 'required|string|max:20',
            'document' => 'required|string|unique:volunteers,document_number|max:50',
            'category' => 'required|string',
        ], [
            'regno.unique' => 'Vounteer with this registration number already exists.',
            'email.unique' => 'Vounteer with this email already exists.',
            'ddcument.unique' => 'Vounteer with this document number already exists.',
        ]);

        $volunteer = Volunteer::create([
            'regno' => $r->regno,
            'name' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'gender' => $r->gender,
            'date_of_birth' => $r->dob,
            'category' => $r->category,
            'nationality' => $r->nationality,
            'document_number' => $r->document,
            'course' => $r->course,
            'batch' => $r->batch,
        ]);

        if ($volunteer)
            return redirect()->route('volunteer.add')->with('success', 'Volunteer Added Successfully !');
        else
            return redirect()->route('volunteer.add')->with('error', 'Some error occured while adding volunteer');
    }

    public function searchDetails(Request $r)
    {
        $search_string = trim($r->search_string); // Trim whitespace from the search string

        $r->validate([
            'search_string' => 'required|string|max:265'
        ]);

        $query = Volunteer::where('id', $search_string)->orWhere('name', 'like', '%' . $search_string . '%');
        $volunteers = $query->paginate(5);

        $courses = Courses::all();
        $batches = Batch::all();

        if ($volunteers->count() > 0) {
            foreach ($volunteers as $v) {
                $v['course'] = $this->courseId_To_courseName($v['course']);
                $v['batch'] = Batch::where('id', $v['batch'])->pluck('name')->first();
            }
            if (Auth::user()->role == 1)
                return view('admin.volunteers.view-edit', compact('volunteers', 'courses', 'batches', 'search_string'));
            else
                return back()->with('volunteers', $volunteers);
        } else
            return back()->with('error', 'No results found for ' . $search_string);
    }

    public function updateDetails(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|numeric',
            'email' => 'required|string|max:50',
            'course' => 'required|numeric',
            'batch' => 'required|numeric',
            'gender' => 'required|string|max:2',
            'dob' => 'required|date',
            'nationality' => 'required|string|max:20',
            'document_number' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $updateVolunteer = Volunteer::where('regno', $r->regno)->update([
            'name' => $r->name,
            'phone' => $r->phone,
            'email' => $r->email,
            'course' => $r->course,
            'batch' => $r->batch,
            'gender' => $r->gender,
            'date_of_birth' => $r->dob,
            'nationality' => $r->nationality,
            'document_number' => $r->document_number,
            'category' => $r->category,
        ]);

        if ($updateVolunteer) {
            return back()->with('success', 'Volunteers details updated successfully !');
        } else
            return back()->with('error', 'Some error occured in updating volunteer details !');
    }

    public function fetchDetails()
    {
        $obj = Volunteer::all();

        $volunteers = $obj->toArray();

        if ($volunteers) {
            return back()->with('volunteers', $volunteers);
        } else {
            return back()->with('error', 'No results found');
        }
    }

    public function getVolunteerInfo($regno)
    {
        $volunteer = Volunteer::where('regno', $regno)->first();

        if ($volunteer) {
            return response()->json($volunteer, 200); // 200 OK
        } else {
            return response()->json(['error' => 'Volunteer not found'], 404); // 404 Not Found
        }
    }

    function courseId_To_courseName($id)
    {
        return Courses::where('id', $id)->pluck('name')->first();
    }

    public function fetch(Request $r)
    {
        $r->validate([
            'batch' => 'required|string',
            'course' => 'required|string',
        ]);

        // All batch and all course
        if ($r->batch == "*" && $r->course == "*") {
            $volunteers = Volunteer::all();
        } elseif ($r->batch == "*") { // All batch and different course
            $volunteers = Volunteer::where('course', $r->course)->get();
        } elseif ($r->course == "*") { // Different batch and all course
            $volunteers = Volunteer::where('batch', $r->batch)->get();
        } else { // Different batch and different course
            $volunteers = Volunteer::where('batch', $r->batch)->where('course', $r->course)->get();
        }
        // dd($volunteers);
        foreach ($volunteers as $v) {
            $v['course'] = $this->courseId_To_courseName($v['course']);
            $v['batch'] = Batch::where('id', $v['batch'])->pluck('name')->first();
        }

        if ($volunteers->count() > 0) {
            return back()->with(['volunteers' => $volunteers, 'batch' => $r->batch, 'course' => $r->course]);
        } else {
            return back()->with('error', 'No details found');
        }
    }

    public function exportView()
    {
        $batches = Batch::all();
        $courses = Courses::all();
        return view('admin.volunteers.export', compact('batches', 'courses'));
    }

    public function exportVolunteers(Request $request)
    {
        $batch = $request->input('batch');
        $course = $request->input('course');

        $batchName = Batch::where('id', $batch)->pluck('name')->first();
        $courseName = Courses::where('id', $course)->pluck('name')->first();

        if($batch === '*' && $course === '*') {
            $fileName = 'SMIT_NSS_VOLUNTEERS_LIST.xlsx';
        } elseif($course === '*') {
            $fileName = 'SMIT_NSS_' . $batchName . '_VOLUNTEERS_LIST.xlsx';
        } elseif($batch === '*') {
            $fileName = 'SMIT_NSS_' . $courseName . '_VOLUNTEERS_LIST.xlsx';
        } else {
            $fileName = 'SMIT_NSS_' . $batchName . '_' . $courseName . '_VOLUNTEERS_LIST.xlsx';
        }

        return Excel::download(new VolunteersExport($batch, $course), $fileName);
    }
}
