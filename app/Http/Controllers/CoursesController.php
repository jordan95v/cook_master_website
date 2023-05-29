<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoursesRequest;
use App\Http\Requests\UpdateCoursesRequest;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = (User::find(Auth::id())->isAdmin() ? Courses::all() : Auth::user()->courses);
        return view('courses.index', ["courses" => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Courses::class);
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursesRequest $request)
    {
        $this->authorize("create", Courses::class);
        $form = $request->validated();
        $form["image"] = $request->file("image")->store("courses", "public");
        $form["user_id"] = Auth::id();
        Courses::create($form);
        return back()->with("success", __("Course created successfully"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        // TODO: UPDATE + SHOW + DELETE + LIMITATIONS
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $course)
    {
        $this->authorize("update", $course);
        return view('courses.edit', ["course" => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursesRequest $request, Courses $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $courses)
    {
        //
    }
}
