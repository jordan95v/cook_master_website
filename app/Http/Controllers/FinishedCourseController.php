<?php

namespace App\Http\Controllers;

use App\Models\FinishedCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishedCourseController extends Controller
{
    public function store(Request $request)
    {
        if (FinishedCourse::where('course_id', $request->route('course'))->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'Course already finished!');
        };
        $form = [
            'course_id' => $request->route('course'),
            'user_id' => Auth::id(),
        ];
        FinishedCourse::create($form);
        return back()->with('success', 'Course finished!');
    }
}
