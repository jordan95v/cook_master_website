<?php

namespace App\Http\Middleware;

use App\Models\UserCourse;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LimitCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user already viewed the course, he can go
        $course_id = $request->route()->parameter('course')->id;
        $user_viewed = UserCourse::where("user_id", $request->user()->id)
            ->where("course_id", $course_id)
            ->whereDate('created_at', '=', Carbon::today()->toDateString())->count();
        if ($user_viewed) {
            return $next($request);
        }

        // Else, check if the user is a pro member
        $user = $request->user();
        try {
            $subscription_name = str_replace("_annual", "", $user->getSubscription()[0]->name);
            if ($subscription_name == "pro") {
                return $next($request);
            }
        } catch (\Exception $e) {
            $subscription_name = "free";
        }

        // Then, check if the user has reached the limit of courses he can take today
        $limit = ($subscription_name == "free" ? 1 : 5);
        if (UserCourse::whereDate('created_at', '=', Carbon::today()->toDateString())->count() >= $limit) {
            return redirect()->route('courses.all')->with('error', 'You have reached the limit of courses you can take today');
        }
        return $next($request);
    }
}
