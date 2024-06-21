<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'regno' => 'required|integer|max:999999999',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required',
        ],[
            'email.unique' => 'Moderator already exists.'
        ]);

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => 2,
            'status' => 1,
        ]);

        if($user)
            return back()->with('success', 'Moderator Added Successfully !');
        else
            return back()->with('error', 'Some error occured in adding moderator !');
    }

    public function viewModerator($id){
        $details = User::where('id', $id)->first();
        return view('admin.users.view', compact('details'));
    }

    public function blockUser(Request $request){
        $request->validate([
            'user_id' => 'required|numeric'
        ]);

        $userBlock = User::where('id', $request->user_id)->update(['status' => 2]); // set to 2 means blocked user

        if($userBlock){
            return redirect()->route('users.manage')->withSuccess('User blocked successfully');
        }else{
            return back()->withErrors('Some error occured in blocking user');
        }
    }
}
