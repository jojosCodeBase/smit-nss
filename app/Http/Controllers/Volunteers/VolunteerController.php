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
        if (Auth::user()->role == 2)
            return view('user.volunteers.add');
        else
            return view('admin.volunteers.add');
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

        return view('admin.volunteers.view-edit', compact('volunteers', 'courses'));

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
        try {
            $volunteer = Volunteer::create([
                'id' => $r->regno,
                'name' => $r->name,
                'email' => $r->email,
                'phone' => $r->phone,
                'gender' => $r->gender,
                'date_of_birth' => $r->dob,
                'category' => $r->category,
                'nationality' => $r->nationality,
                'document_number' => $r->document_number,
                'course' => $r->course,
                'batch' => $r->batch,
            ]);

            if ($volunteer)
                return redirect()->route('volunteer.add')->withSuccess('success');
            else
                return redirect()->route('volunteer.add')->with('error', 'Some error occured while adding volunteer');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->route('volunteer.add')->with('error', 'Volunteer Already Exists');
            }
        }
    }

    public function searchDetails(Request $r)
    {
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
        // dd("hello");
        $user = Volunteer::where('id', $regno)->first();
        // $user = $user->toArray();
        if ($user)
            return response()->json(['name' => $user->name]);
        else
            return response()->json(['name' => 'No results found']);
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
