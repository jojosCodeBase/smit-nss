<?php

namespace App\Http\Controllers;

use App\Models\Drives\Drive;
use Illuminate\Http\Request;
use App\Models\Volunteers\Volunteer;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance\Attendance;
use Illuminate\Database\QueryException;

class AttendanceController extends Controller
{
    public function add(Request $r){
        try {
            $attend = Attendance::create([
                'regno' => $r->regno,
                'driveId' => $r->id,
            ]);

            $drive = Drive::where('id', $r->id)->update([
                'attendanceBy' => Auth::user()->id,
            ]);

            if ($attend && $drive) {
                return back()->with('success', 'Attendance added successfully!');
            } else {
                return back()->with('error', 'Some error occurred in adding attendance!');
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) { // Duplicate entry error code
                return back()->with('error', 'Duplicate entry. Attendance already added.');
            } else {
                return back()->with('error', 'Some error occurred in adding attendance!');
            }
        }
    }
    // public function delete(Request $r){

    // }
    public function update(Request $r){

    }

    public function delete(Request $r){
        $delete = Attendance::where('regno', $r->regno)->delete();
        if($delete){
            return back()->with('success', 'Attendance deleted successfully !');
        }else{
            return back()->with('error', 'Some error occured in deleting attendance !');
        }
    }
}
