<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $roles = [1, 2];
        $users = User::whereIn('role', $roles)->get();
        $moderatorCount = User::where('role', 2)->count();
        return view('admin.users.manage', compact('users', 'moderatorCount'));
    }

    public function addModerator(Request $r){
        $r->validate([
            'regno' => 'required',
            'password' => 'required',
        ]);

        // $r->validate([
            //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $userInfo = Volunteer::where('id', $r->regno)->first();
        // dd($userInfo);

        $user = User::create([
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'password' => Hash::make($r->password),
        ]);

        if($user)
            return back()->with('success', 'Moderator Added Successfully !');
        else
            return back()->with('error', 'Some error occured in adding moderator !');
    }
}
