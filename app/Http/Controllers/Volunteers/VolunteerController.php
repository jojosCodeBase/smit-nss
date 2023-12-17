<?php

namespace App\Http\Controllers\Volunteers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function manage(){
        return view('volunteers.manage');
    }
    public function add(){
        return view('volunteers.add');
    }
    public function search(){
        return view('volunteers.search');
    }
}
