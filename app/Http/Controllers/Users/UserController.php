<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
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
        $roles = [1, 2];
        $users = User::whereIn('role', $roles)->get();
        // dd($users);
        return view('admin.users.manage', compact('users'));
    }
}
