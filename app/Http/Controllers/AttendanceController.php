<?php

namespace App\Http\Controllers;

use App\Models\Drives\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance\Attendance;

class AttendanceController extends Controller
{
    public function add(Request $r){
        $attend = Attendance::where('regno', $r->regno)->create([
            'regno' => $r->regno,
            'driveId' => $r->driveId,
        ]);

        $drive = Drive::where('id', $r->driveId)->update([
            'attendanceBy' => Auth::user()->id(),
        ]);

        $drive = $drive->toArray();

        $attend = Attendance::where('regno', $r->regno)
            ->andWhere('driveId', $r->driveId)
            ->get();

        $attend = $attend->toArray();

        if($attend && $drive){
            return back()->with(['success' => 'Attendance added successfully !', 'attend' => $attend]);
        }else{
            return back()->with('error', 'Some error occured in adding attendance');
        }
    }
    public function delete(Request $r){

    }
    public function update(Request $r){

    }

    // public function showDrive(Request $r){

    // }
}
