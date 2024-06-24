<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Drive;
use App\Models\Courses;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalVolunteers = Volunteer::count();
        $totalDrives = Drive::count();
        $totalBatch = Batch::count();
        if ($totalBatch != 0) {
            $batchInfo = Batch::latest()->limit(2);
        } else {
            $batchInfo = 0;
        }

        $drives = Drive::orderBy('date', 'desc')->limit(5)->get();
        if (Auth::user()->role == 1)
            return view('admin.dashboard', compact('totalDrives', 'totalVolunteers', 'drives', 'batchInfo'));
        else
            return view('user.dashboard', compact('totalDrives', 'totalVolunteers', 'drives', 'batchInfo'));
    }

    public function manageCourses()
    {
        return view('admin.course.manage', ['courses' => Courses::orderBy('name')->paginate(10)]);
    }

    public function updateCourse(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:20'
        ]);

        $update = Courses::where('id', $request->course_id)->update([
            'name' => $request->course
        ]);

        if ($update)
            return back()->withSuccess('Course updated successfully');
        else
            return back()->withErrors('Some error occured in updating course');
    }
    public function addCourse(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:20|unique:courses,name'
        ],[
            'course.unique' => 'The course already exists.',
        ]);
        $add = Courses::create([
            'name' => $request->course,
        ]);
        if ($add)
            return back()->withSuccess('Course added successfully');
        else
            return back()->withErrors('Some error occured in adding course');
    }

    public function deleteCourse(Request $request){
        $course = Courses::where('id', $request->cid)->delete();

        if($course)
            return back()->withSuccess('Course deleted successfully');
        else
            return back()->withErrors('Some error occured in deleting course');
    }
}
