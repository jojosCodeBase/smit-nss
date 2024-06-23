<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function create()
    {
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
                'email' => 'Email not registered.',
            ]);
        }

        if ($user->status == 2) {
            return back()->withErrors([
                'email' => 'Your account has been discontinued. Thank you for your service.'
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
            return '/user/dashboard';
        } else {
            return '/';
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }

    public function resetPasswordView(Request $request)
    {
        return view('auth.reset-password', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login-page')->with('success', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
