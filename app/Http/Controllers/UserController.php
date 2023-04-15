<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use function PHPUnit\Framework\fileExists;
use Illuminate\Auth\Events\Registered;
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
        return view("users.create");
    }

    // Store a newly created resource in storage.
    public function store(CreateUserRequest $request)
    {
        $form = $request->validated();
        $form["password"] = bcrypt($form["password"]);
        $user = User::create($form);
        event(new Registered($user));
        Auth::login($user);
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
        if ($request->hasFile("image")) {
            $form["image"] = $request->file("image")->store("user_avatar", "public");
        }
        User::find(Auth::id())->update($form);
        return back()->with("success", "You successfully edited your profile");
    }

    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        $this->authorize("delete", $user);
        if (fileExists("storage/" . $user->image)) {
            unlink("storage/" . $user->image);
        }
        $user->delete();
        if (Auth::id() != $user->id) {
            return back()->with("success", "Vous avez bien supprimé le compte de $user->name.");
        }
        return redirect("/")->with("success", "Vous avez bien supprimé votre compte.");
    }

    public function ban(User $user)
    {
        $this->authorize("ban", $user);
        $user->update(["is_banned" => 1]);
        return back()->with("success", "Vous avez banni $user->name.");
    }

    public function unban(User $user)
    {
        $this->authorize("ban", $user);
        $user->update(["is_banned" => 0]);
        return back()->with("success", "Vous avez débanni $user->name.");
    }
}
