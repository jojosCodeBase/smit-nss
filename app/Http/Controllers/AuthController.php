<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Please enter your username.',
            'email.email' => 'Please enter a valid username.',
            'password.required' => 'Please enter your password.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Username is not registered.',
            ]);
        }

        // If user exists, try to authenticate
        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential, $request->has('remember'))) {
            return redirect($this->redirectDash());
        } else {
            return back()->withErrors([
                'password' => 'Password is incorrect.',
            ]);
        }
    }

    private function redirectDash()
    {
        if (Auth::user() && Auth::user()->role == 1) {
            return '/admin/dashboard';
        } elseif (Auth::user() && Auth::user()->role == 2) {
            return '/dashboard';
        }else {
            return '/';
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
