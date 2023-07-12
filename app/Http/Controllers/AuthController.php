<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Show the login form.
    public function showLogin()
    {
        return view("users.login");
    }

    // Log the user.
    public function login(Request $request)
    {
        $form = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt($form)) {
            // Set user as active.
            $user = User::find(Auth::id());
            $user->update(["is_active" => true]);
            $request->session()->regenerate();
            return redirect()->route("user.planning")->with("success", "You are now logged in !");
        }
        return back()->with("error", "These credentials do not match our records.")->onlyInput("email");
    }

    // Logout the user.
    public function logout(Request $request)
    {
        // Set user as inactive.
        $user = User::find(Auth::id());
        $user->update(["is_active" => false]);

        // Logout the user.
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with("success", "You logged out.");
    }

    // Notice the the user to verify his email.
    public function notice()
    {
        return redirect()->route("user.planning")->with("error", "Check your email first.");
    }

    // Verify the email.
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route("user.planning")->with("success", "You have verified your email.");
    }

    // Resend the email.
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with("success", "Check your email for the confirmation link.");
    }

    public function show_password_request()
    {
        return view("users.forgot");
    }

    public function send_password_request(Request $request)
    {
        $request->validate([
            "email" => "required|email",
        ]);

        $status = Password::sendResetLink(
            $request->only("email")
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with(['success' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }

    public function show_password_reset($token)
    {
        return view("users.reset", ["token" => $token]);
    }

    public function password_reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }
}
