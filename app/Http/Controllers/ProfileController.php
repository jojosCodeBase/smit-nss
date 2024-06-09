<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email',
        // ]);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ], [
            'email.unique' => 'The email has already been taken',
        ]);

        $user = Auth::user();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
