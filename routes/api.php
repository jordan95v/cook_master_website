<?php

use App\Models\Course;
use App\Models\Event;
use App\Models\FinishedCourse;
use App\Models\Formation;
use App\Models\FormationUser;
use App\Models\OrderInvoice;
use App\Models\Product;
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
            $total_event_created_by_admin = 0;
            $total_event_created_by_service_provider = 0;
            foreach (Event::all() as $event) {
                if ($event->user->isAdmin()) {
                    $total_event_created_by_admin++;
                } elseif ($event->user->is_service_provider) {
                    $total_event_created_by_service_provider++;
                }
            }
            return [
                "total_event" => Event::count(),
                "past_event" => Event::where("date", "<", date("Y-m-d"))->count(),
                "upcoming_event" => Event::where("date", ">=", date("Y-m-d"))->count(),
                "workshop_number" => Event::where("is_course", true)->count(),
                "total_event_created_by_admin" => $total_event_created_by_admin,
                "total_event_created_by_service_provider" => $total_event_created_by_service_provider,
                "top_five_event" => Event::orderBy("capacity", "desc")->take(5)->get(),
            ];
        });

        Route::get("/services", function () {
            return [
                "total_commands" => OrderInvoice::count(),
                "total_products" => Product::count(),
                "total_formations" => Formation::count(),
                "total_courses" => Course::count(),
                "total_finished_formation" => FormationUser::where("is_finished", true)->count(),
                "total_ongoing_formation" => FormationUser::where("is_finished", false)->count(),
                "total_finished_courses" => FinishedCourse::count(),
            ];
        });

        Route::get("/users", function () {
            $total_free = 0;
            $total_starter = 0;
            $total_pro = 0;

            // Gather information about the user.
            foreach (User::all() as $user) {
                $subscription_name = strstr($user->getSubscription()[0]->name ?? "free", "_annual", true);
                switch ($subscription_name) {
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
            }

            return [
                "total_users" => User::count(),
                "total_active_users" => User::where("is_active", true)->count(),
                "total_service_provider" => User::where("is_service_provider", true)->count(),
                "total_admin" => User::where("role", 1)->count(),
                "total_super_admin" => User::where("role", 2)->count(),
                "total_service_provider" => User::where("is_service_provider", true)->count(),
                "total_free" => $total_free,
                "total_starter" => $total_starter,
                "total_pro" => $total_pro,
                "top_five_user" => User::orderBy("total_command", "desc")->take(5)->get(),
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
