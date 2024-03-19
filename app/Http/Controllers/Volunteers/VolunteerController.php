<?php

namespace App\Http\Controllers\Volunteers;

use App\Models\Batch\Batch;
use Illuminate\Http\Request;
use App\Models\Courses\Courses;
use App\Http\Controllers\Controller;
use App\Models\Volunteers\Volunteer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Database\QueryException;

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
        $volunteers = Volunteer::paginate(10);
        foreach ($volunteers as $v) {
            $v['course'] = $this->courseId_To_courseName($v['course']);
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

    public function delete(Request $r){
        $delete = Volunteer::where('id', $r->regno)->delete();
        if($delete){
            return back()->with('success', 'Volunteer deleted successfully !');
        }else{
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
            'regno' => 'required|numeric|unique:volunteers,id|max:999999999',
            'email' => 'required|email|unique:volunteers,email',
            'gender' => 'required|string|max:2',
            'phone' => 'required|numeric|max:9999999999',
            'dob' => 'required|date',
            'batch' => 'required|numeric|max:99',
            'course' => 'required|numeric|max:99',
            'document' => 'required|string|unique:volunteers,document_number|max:50',
        ],[
            'regno.unique' => 'Vounteer with this registration number already exists.',
            'email.unique' => 'Vounteer with this email already exists.',
            'ddcument.unique' => 'Vounteer with this document number already exists.',
        ]);
        // dd($r->all());
        $volunteer = Volunteer::create([
            'id' => $r->regno,
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
        $r->validate([
            'search_string' => 'required|string|max:265'
        ]);
        // this returns an object
        $query = Volunteer::where('id', $r->search_string)
            ->orWhere('name', 'like', '%' . $r->search_string . '%');

        //converting the returned object to array
        $volunteers = $query->paginate(5);

        if ($volunteers->count() > 0) {
            foreach ($volunteers as $v) {
                $v['course'] = $this->courseId_To_courseName($v['course']);
            }
            if (Auth::user()->role == 1)
                return view('admin.volunteers.view-edit', compact('volunteers'));
            else
                return back()->with('volunteers', $volunteers);
        } else
            return back()->with('error', 'No results found for ' . $r->search_string);
    }

    public function updateDetails(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|numeric',
            'email' => 'required|string|max:50',
            'course' => 'required|numeric',
            'batch' => 'required|string|max:10',
        ]);
        $updateVolunteer = Volunteer::where('id', $r->regno)->update([
            'name' => $r->name,
            'phone' => $r->phone,
            'email' => $r->email,
            'course' => $r->course,
            'batch' => $r->batch,
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

    public function getName($regno)
    {
        // this is used to fetch the first occurence of the given id and no need to use volunteer[0] to access array elements
        $volunteer = Volunteer::where('id', $regno)->first();
        if ($volunteer)
            return response()->json(['name' => $volunteer->name]);
        else
            return response()->json(['name' => 'No results found']);
    }
    public function getVolunteerInfo($regno)
    {
        return response()->json(['volunteer' => Volunteer::where('id', $regno)->get()]);
    }
    public function ajax(Request $upload)
    {
        $user = Volunteer::where('id', $upload->title)->first();
        // $desc = $upload->description;
        if ($user)
            return response()->json(['message' => $user->name]);
        else
            return response()->json(['message' => 'No results found']);
    }

    function courseId_To_courseName($id)
    {
        $courseMapping = [
            0 => "MCA",
            1 => "BCA",
            2 => "MBA",
            3 => "BBA",
            4 => "MSc Chemistry",
            5 => "BSc Chemistry",
            6 => "MSc Mathematics",
            7 => "BSc Mathematics",
            8 => "MSc Physics",
            9 => "BSc Physics",
            10 => "BTech CSE",
            11 => "BTech CE",
            12 => "BTech ME",
            13 => "BTech AI&DS",
            14 => "BTech IT",
            15 => "BTech EEE",
            16 => "BTech ECE",
        ];

        if (array_key_exists($id, $courseMapping)) {
            return $courseMapping[$id];
        } else {
            return 'Unknown Course';
        }
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
        foreach ($volunteers as $v) {
            $v['course'] = $this->courseId_To_courseName($v['course']);
        }

        if ($volunteers->count() > 0) {
            return back()->with('volunteers', $volunteers);
        } else {
            return back()->with('error', 'No details found for batch specified');
        }
    }

    public function exportView()
    {
        $batches = Batch::pluck('name');
        $courses = Courses::all();
        return view('admin.volunteers.export', compact('batches', 'courses'));
    }
}
