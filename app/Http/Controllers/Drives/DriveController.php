<?php

namespace App\Http\Controllers\Drives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriveController extends Controller
{
    function manage(){
        return view('drives.manage');
    }
    function add(){
        return view('drives.add');
    }
    function attendance(){
        return view('drives.attendance');
    }
}
