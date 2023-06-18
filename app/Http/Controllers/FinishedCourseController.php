<?php

namespace App\Http\Controllers;

use App\Models\FinishedCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishedCourseController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::id());
        $finished_courses = $user->finished_courses;
        return view('finished_courses.index', ['finished_courses' => $finished_courses]);
    }

    public function store(Request $request)
    {
        $form = [
            'course_id' => $request->route('course'),
            'user_id' => Auth::id(),
        ];
        FinishedCourse::create($form);
        return back()->with('status', 'Course finished!');
    }
}
