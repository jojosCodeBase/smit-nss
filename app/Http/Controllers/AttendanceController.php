<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Illuminate\Database\QueryException;

class AttendanceController extends Controller
{
    public function add(Request $r){
        $r->validate([
            'regno' => 'required|numeric|max:9999999999',
            'drive_id' => 'required|numeric',
        ]);

        $attend = Attendance::create([
            'regno' => $r->regno,
            'drive_id' => $r->drive_id,
        ]);

        $drive = Drive::where('id', $r->drive_id)->first();

        $drive = Drive::where('id', $r->drive_id)->update([
            'updatedBy' => Auth::user()->id,
            'present' => $drive['present']+1,
        ]);

        // update volunteer's drives_participated also

        $volunteer = Volunteer::where('regno', $r->regno)->first();
        $participated = Volunteer::where('regno', $r->regno)->update([
            'drives_participated' => $volunteer['drived_participated']+1,
        ]);

        if ($attend && $drive && $participated) {
            return back()->with('success', 'Attendance added successfully!');
        } else {
            return back()->with('error', 'Some error occurred in adding attendance!');
        }
        // return back()->with('error', 'Duplicate entry. Attendance already added.');
    }
    public function delete(Request $r){
        $attendance = Attendance::where('regno', $r->regno)->delete();
        $drive = Drive::where('id', $r->driveId)->get();
        $presentCount = $drive[0]['present']-1;

        $drive = Drive::where('id', $r->driveId)->update([
            'updatedBy' => Auth::user()->id,
            'present' => $presentCount,
        ]);

        if($attendance && $drive){
            // dd('delete successful');
            return back();
        }else{
            return back()->with('error', 'Some error occured in deleting attendance');
        }
    }
    // public function update(Request $r){

    // }

    // public function delete(Request $r){
    //     $delete = Attendance::where('regno', $r->regno)->delete();
    //     if($delete){
    //         return back()->with('success', 'Attendance deleted successfully !');
    //     }else{
    //         return back()->with('error', 'Some error occured in deleting attendance !');
    //     }
    // }
}
