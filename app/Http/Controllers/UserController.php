<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form = $request->validate([
            "name" => "required|min:6|unique:users,name",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed"
        ]);

        $form["password"] = bcrypt($form["password"]);
        User::create($form);
        return redirect("/")->with("success", "Vous avez crée votre compte, connectez vous !");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function showLogin(Request $request)
    {
        return view("users.login");
    }

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with("success", "Vous vous êtes déconnecté.");
    }
}
