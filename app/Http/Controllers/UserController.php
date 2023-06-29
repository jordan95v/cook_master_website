<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        if ($form["key"] ?? false) {
            $form["godfather_key"] = $form["key"];
        }
        $form["key"] = Str::random(32);
        $form["password"] = bcrypt($form["password"]);
        $form["api_key"] = Str::random(32);

        // Create the user
        $user = User::create($form);
        $user->createAsStripeCustomer();
        // event(new Registered($user));
        Auth::login($user);
        return redirect("/")->with("success", "Check your email to verify your account.");
    }

    // Display the specified resource.
    public function finished_course()
    {
        return view("users.finished_courses");
    }

    public function planning()
    {
        return view("users.planning");
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
            if (Auth::user()->image && file_exists("storage/" . Auth::user()->image)) {
                unlink("storage/" . Auth::user()->image);
            }
            $form["image"] = $request->file("image")->store("avatar", "public");
        }
        User::find(Auth::id())->update($form);
        return back()->with("success", "You successfully edited your profile.");
    }

    // Remove the specified resource from storage.
    public function destroy(User $user)
    {
        $this->authorize("delete", $user);
        if (Auth::user()->image) {
            if (file_exists("storage/" . Auth::user()->image)) {
                unlink("storage/" . Auth::user()->image);
            }
        }
        $user->delete();
        if (Auth::id() != $user->id) {
            return back()->with("success", "You successfully deleted the user's account.");
        }
        return redirect("/")->with("success", "You successfully deleted your account.");
    }

    public function manage_ban(User $user)
    {
        $this->authorize("ban", $user);
        if ($user->is_banned) {
            $user->update(["is_banned" => 0]);
            return back()->with("success", "You successfully unbanned the user.");
        }
        $user->update(["is_banned" => 1]);
        return back()->with("success", "You successfully banned the user.");
    }

    public function manage_admin(User $user)
    {
        $this->authorize("manage", $user);
        if ($user->role == 1) {
            $user->update(["role" => 0]);
            return back()->with("success", "You successfully demoted the user.");
        }
        $user->update(["role" => 1]);
        return back()->with("success", "You successfully promoted the user.");
    }

    public function manage_service_provider(User $user)
    {
        $this->authorize("add_service_provider", $user);
        if ($user->is_service_provider) {
            $user->update(["is_service_provider" => 0]);
            return back()->with("success", "You successfully demoted the user.");
        }
        $user->update(["is_service_provider" => 1]);
        return back()->with("success", "You successfully promoted the user.");
    }

    public function invoices()
    {
        return view("users.invoices");
    }

    public function formations()
    {
        return view("users.taken_formations");
    }

    public function home_courses()
    {
        return view("users.home_courses");
    }
}
