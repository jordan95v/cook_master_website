<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = (User::find(Auth::id())->isAdmin() ? Course::all() : Auth::user()->courses);
        return view('course.index', ["courses" => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Course::class);
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $this->authorize("create", Course::class);
        $form = $request->validated();
        $form["image"] = $request->file("image")->store("courses", "public");
        $form["user_id"] = Auth::id();
        Course::create($form);
        return back()->with("success", "Course created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorize("update", $course);
        return view('course.edit', ["course" => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->authorize("update", $course);
        $form = $request->validated();
        if ($request->hasFile("image")) {
            if (file_exists("storage/" . $course->image)) {
                unlink("storage/" . $course->image);
            }
            $form["image"] = $request->file("image")->store("courses", "public");
        }
        $course->update($form);
        return back()->with("success", "Course updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
