<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect("/")->with("success", "You are now logged in !");
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
        return redirect("/")->with("error", "Check your email first.");
    }

    // Verify the email.
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect("/")->with("success", "You have verified your email.");
    }

    // Resend the email.
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with("success", "Check your email for the confirmation link.");
    }
}
