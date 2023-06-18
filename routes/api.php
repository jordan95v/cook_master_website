<?php

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("v1")->group(function () {

    Route::post("/login", function (Request $request) {
        if (Auth::once($request->only("email", "password"))) {
            $key = User::where("email", $request->email)->first()->api_key;
            return response()->json(["key" => $key], 200);
        } else {
            return response()->json(["error" => "Invalid credentials."], 401);
        }
    });

    Route::middleware('check_api_key')->group(function () {
        Route::get("/events", function () {
            $events = Event::all()->jsonSerialize();

            // Gather information about the event.
            foreach ($events as $key => $event) {
                $orm_event = Event::where("id", $event["id"])->first();
                $events[$key]["participants"] = $orm_event->participants->jsonSerialize();
                $events[$key]["room"] = $orm_event->room->jsonSerialize();
            }

            return $events;
        });

        Route::get("/users", function () {
            $users = User::all()->jsonSerialize();

            $total_free = 0;
            $total_starter = 0;
            $total_pro = 0;
            // Gather information about the user.
            foreach ($users as $key => $user) {
                $orm_user = User::where("id", $user["id"])->first();
                switch ($orm_user->getSubscription()[0]->name ?? "free") {
                    case "free":
                        $total_free++;
                        break;
                    case "starter":
                        $total_starter++;
                        break;
                    case "pro":
                        $total_pro++;
                        break;
                }
                $users[$key]["is_admin"] = $orm_user->isAdmin();
            }

            return [
                "total_users" => count($users),
                "total_active_users" => User::where("is_active", true)->count(),
                "total_service_provider" => User::where("is_service_provider", true)->count(),
                "total_free" => $total_free,
                "total_starter" => $total_starter,
                "total_pro" => $total_pro,
            ];
        });

        Route::get("/courses", function () {
            return Course::simplePaginate(10)->jsonSerialize();
        });

        Route::get("courses/{id}", function ($id) {
            try {
                return Course::findOrFail($id)->jsonSerialize();
            } catch (Exception $e) {
                return response()->json(["error" => "Course not found."], 404);
            }
        });
    });
});
