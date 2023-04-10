<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        //
    }


    // Show the form for creating a new resource.
    public function create()
    {
        return view("users.register");
    }


    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $form = $request->validate([
            "name" => "required|min:6|unique:users,name",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed"
        ]);

        $form["password"] = bcrypt($form["password"]);
        $user = User::create($form);
        event(new Registered($user));
        return redirect("/")->with("success", "Vous avez crée votre compte, connectez vous !");
    }


    // Display the specified resource.
    public function show(User $user)
    {
        //
    }


    // Show the form for editing the specified resource.
    public function edit()
    {
        return view('users.edit', ["user" => Auth::user()]);
    }


    // Update the specified resource in storage.
    public function update(Request $request, User $user)
    {
        if (Auth::user() != $user) {
            return redirect("/")->with("error", "You are not allowed to do this.");
        }
        $form = $request->validate([
            "name" => "required|unique:users,name,$user->id",
            "email" => "required|unique:users,email,$user->id",
        ]);


        if ($request["password"] != null) {
            $request->validate([
                "password" => "confirmed|min:6"
            ]);
            $form["password"] = bcrypt($request["password"]);
        }
        $user->update($form);
        return back()->with("success", "You successfully edited your profile");
    }


    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        if (Auth::user() != $user) {
            return redirect("/")->with("error", "Comment ça mon reuf ?");
        }
        $user->delete();
        return redirect("/")->with("success", "Vous avez supprimé votre compte.");
    }
}
