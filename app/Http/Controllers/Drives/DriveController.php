<?php

namespace App\Http\Controllers\Drives;

use App\Models\Drives\Drive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DriveController extends Controller
{
    function listAll(){
        $query = Drive::orderBy('id', 'desc')->get();
        $drives = $query->toArray();
        return view('admin.drives.manage', compact('drives'));
    }
    function addView(){
        $recentDrive = Drive::latest()->first();
        $id = $recentDrive->id + 1;

        // 'user' is authenticated to add drive
        if(Auth::user()->role == 2)
            return view('user.drives.add', compact('id'));
        else
            return view('admin.drives.add', compact('id'));

    }

    function searchDrive(Request $r){
        $query = Drive::where('title', $r->search_string)->get();
        $drives = $query->toArray();

        if($drives){
            return view('admin.drives.manage', compact('drives'));
        }
        else{
            return back()->with('error', 'No records found for ' . $r->search_string);
        }
    }

    function showAttendance(){
        $drives = Drive::orderBy('id', 'desc')->get();
        $drives = $drives->toArray();

        // 'user' is authenticated to add drive attendance
        if(Auth::user()->role == 2)
            return view('user.drives.attendance', compact('drives'));
        else
            return view('admin.drives.attendance', compact('drives'));
    }

    function addAttendance(){
        $drive = Drive::whereDate('created_at', Carbon::today())->get();
        $drive = $drive->toArray();

        if($drive)
            return view('user.drives.attendance',compact('drive'));
        else
            return back()->with('eror', 'No drives found');
    }

    function addDrive(Request $r){
        $drive = Drive::create([
            'id' => $r->id,
            'title' => $r->title,
            'date' => $r->date,
            'from' => $r->from,
            'to' => $r->to,
            'conductedBy' => $r->conductedBy,
            'type' => $r->driveType,
            'area' => $r->area,
            'present' => $r->present,
            'description' => $r->description,
        ]);

        if($drive){
            return back()->with('success', 'Drive created successfully !');
        }
        else{
            return back()->with('error', 'Some error occured in creating drive !');
        }
    }

    function update(Request $r){
        $drive = Drive::where('id', $r->id)->update([
            'title' => $r->title,
            'date' => $r->date,
            'from' => $r->from,
            'to' => $r->to,
            'conductedBy' => $r->conductedBy,
            'type' => $r->driveType,
            'area' => $r->area,
            'present' => $r->present,
            'description' => $r->description,
        ]);

        if($drive){
            return back()->with('success', 'Drive details updated successfully !');
        }
        else{
            return back()->with('error', 'Some error occured in updating drive details !');
        }
    }

    function delete(Request $r){
        $drive = Drive::where('id', $r->id)->delete();

        if($drive){
            return back()->with('success', 'Drive deleted successfully !');
        }
        else{
            return back()->with('error', 'Some error occured in deleting drive !');
        }
    }
}
