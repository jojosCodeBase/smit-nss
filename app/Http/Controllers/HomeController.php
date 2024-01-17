<?php

namespace App\Http\Controllers;

use App\Models\Batch\Batch;
use App\Models\Drives\Drive;
use Illuminate\Http\Request;
use App\Models\Volunteers\Volunteer;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $totalVolunteers = Volunteer::count();
        $totalDrives = Drive::count();
        $batches = Batch::all();
        $batchInfo = ['batch1' => $batches[0], 'batch2' => $batches[1]];

        $drives = Drive::orderBy('created_at', 'desc')->limit(5)->get();
        if(Auth::user()->role == 1)
            return view('admin.home', compact('totalDrives', 'totalVolunteers', 'drives',  'batchInfo'));
        else
            return view('user.home', compact('totalDrives', 'totalVolunteers', 'drives', 'batchInfo'));
    }
}
