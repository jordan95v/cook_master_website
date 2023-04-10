<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
            "password" => "required"
        ]);

        if (Auth::attempt($form)) {
            $request->session()->regenerate();
            return redirect("/")->with("success", "Vous vous êtes correctement connecté.");
        }
        return back()->with("error", "Les informations de connection ne sont pas correctes.")->onlyInput("email");
    }


    // Logout the user.
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with("success", "Vous vous êtes déconnecté.");
    }


    public function notice()
    {
        return redirect("/")->with("error", "Vérifier votre email d'abord.");
    }


    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect("/")->with("success", "Vous avez bien vérifié votre mail.");
    }
}
