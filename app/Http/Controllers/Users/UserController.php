<?php

namespace App\Http\Controllers\USers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->role == 2)
            return view('user.profile.edit');
        else
            return view('admin.profile.edit');
    }

    public function listUsers(){
        return view('admin.users.manage');
    }
}
