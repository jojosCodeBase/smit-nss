<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role == 0)
            return redirect()->intended(RouteServiceProvider::HOME);
        elseif (Auth::user()->role == 1)
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        return redirect()->intended(RouteServiceProvider::USER_HOME); 
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function sessionValidate()
    {
        if (Auth::user()) {
            if (Auth::user() && Auth::user()->role == 0) {
                return redirect()->route('home');
            } elseif (Auth::user() && Auth::user()->role == 1) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('user.home');
            }
        } else {
            return redirect()->route('welcome');
        }
    }
}
