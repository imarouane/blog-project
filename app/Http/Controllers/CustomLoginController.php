<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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

    public function customPasswordReset(Request $request, $token)
    {
        $email = $request->query('email');
        return view('custom-auth.custom-passwords.custom-password-reset', ['email' => $email, 'token' => $token]);
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

    public function customPasswordUpdate(Request $request)
    {
        $request->validate(
            [
                'email' => 'email|required',
                'token' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]
        );

        $status = Password::reset($request->only('email', 'password', 'password_confiramtion', 'token'), function (User $user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(20));

            $user->save();
        });

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('custom.login')->with(['status' => __($status)]);
        } else {
            return back()->withErrors(['status' => __($status)]);
        }
    }
}
