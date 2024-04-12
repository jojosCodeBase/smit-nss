<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Drives\Drive;
use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $totalVolunteers = Volunteer::count();
        $totalDrives = Drive::count();
        $totalBatch = Batch::count();
        if($totalBatch != 0){
            $batchInfo = Batch::latest()->limit(2);
        }else{
            $batchInfo = 0;
        }


        $drives = Drive::orderBy('date', 'desc')->limit(5)->get();
        if(Auth::user()->role == 1)
            return view('admin.home', compact('totalDrives', 'totalVolunteers', 'drives',  'batchInfo'));
        else
            return view('user.home', compact('totalDrives', 'totalVolunteers', 'drives', 'batchInfo'));
    }
}
