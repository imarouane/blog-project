<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class CustomLoginController extends Controller
{

    public function index()
    {
        return view('custom-auth.custom-login');
    }

    public function customRegister()
    {
        return view('custom-auth.custom-register');
    }

    public function passwordRecoveryEmail()
    {
        return view('custom-auth.custom-passwords.password-recovery-email');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            return redirect()->route('admin.dashboard.index');
        }

        return redirect()->route('custom.login')->withErrors(['status' => __('auth.failed')]);
    }

    public function customLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('custom.login');
    }

    public function customReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
