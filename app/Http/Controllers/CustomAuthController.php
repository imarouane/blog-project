<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('custom-auth.custom-login');
    }

    public function customRegisterIndex()
    {
        return view('custom-auth.custom-register');
    }

    public function passwordRecoveryEmail()
    {
        return view('custom-auth.custom-passwords.password-recovery-email');
    }

    public function customRegister(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $inputs = $request->only('firstname', 'lastname', 'email', 'password', 'password_confirmation');

        try {
            $user = User::create($inputs);
            Auth::login($user);
            return redirect()->route('admin.dashboard.index');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode === 1062) {
                return redirect()->back()->withInput()->withErrors(['email' => 'The email address has already been taken.']);
            }
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while registering.']);
        }
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
