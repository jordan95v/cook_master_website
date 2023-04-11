<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        return view("users.index", ["users" => User::where("id", "!=", Auth::id())->get()]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view("users.register");
    }

    // Store a newly created resource in storage.
    public function store(CreateUserRequest $request)
    {
        $form = $request->validated();
        $form["password"] = bcrypt($form["password"]);
        $user = User::create($form);
        event(new Registered($user));
        return redirect("/")->with("success", "Vous avez créé votre compte, vérifier votre email pour accéder à toutes les fonctionnalités !");
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
    public function update(UpdateUserRequest $request)
    {
        $form = $request->validated();
        if ($form["password"] ?? false) {
            $form["password"] = bcrypt($form["password"]);
        }
        User::find(Auth::id())->update($form);
        return back()->with("success", "You successfully edited your profile");
    }

    // Remove the specified resource from storage.
    public function destroy()
    {
        User::find(Auth::id())->delete();
        return redirect("/")->with("success", "Vous avez supprimé votre compte.");
    }
}
