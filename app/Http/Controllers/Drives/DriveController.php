<?php

namespace App\Http\Controllers\Drives;

use App\Models\Drives\Drive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriveController extends Controller
{
    function listAll(){
        $drives = Drive::orderBy('id', 'desc')->get();
        // dd($drives);
        return view('drives.manage', compact('drives'));
    }
    function addView(){
        $recentDrive = Drive::latest()->first();
        $id = $recentDrive->id + 1;
        return view('drives.add', compact('id'));
    }
    function attendance(){
        return view('drives.attendance');
    }

    function addDrive(Request $r){
        // dd($r->conductedBy);
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
            'absent' => $r->absent,
            'description' => $r->description,
        ]);

        if($drive){
            return back()->with('success', 'Drive created successfully !');
        }
        else{
            return back()->with('error', 'Some error occured in creating drive !');
        }
    }
}
