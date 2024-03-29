<?php

use App\Http\Requests\StoreUserAPIRequest;
use App\Models\Course;
use App\Models\Event;
use App\Models\Formation;
use App\Models\FormationUser;
use App\Models\OrderInvoice;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    // Auth routes
    Route::post("/login", function (Request $request) {
        if (Auth::once($request->only("email", "password"))) {
            $key = User::where("email", $request->email)->first()->api_key;
            return response()->json(["key" => $key], 200);
        } else {
            return response()->json(["error" => "Invalid credentials."], 401);
        }
    });

    Route::post("/register", function (StoreUserAPIRequest $request) {
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
        return response()->json(["key" => $user->api_key], 200);
    });

    Route::middleware('check_api_key')->group(function () {
        Route::get("/user", function () {
            $token = request()->header("API_KEY");
            $user = User::where("api_key", $token)->first();
            $user->subscription_name = str_replace('_annual', '', $user->getSubscription()[0]->name ?? "free");
            return $user->jsonSerialize();
        });

        Route::post("/user/ten_euros_bonus", function () {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            if (!$user->had_nfc_discount) {
                $user->update(["total_discount" => $user->total_discount + 10, "had_nfc_discount" => true]);
                return response()->json(["message" => "10€ added to account."]);
            }
            return response()->json(["error" => "You already add the discount."], 401);

        });

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
                "total_finished_courses" => UserCourse::where("is_finished", true)->count(),
            ];
        });

        Route::get("/users", function () {
            $total_free = 0;
            $total_starter = 0;
            $total_pro = 0;

            // Gather information about the user.
            foreach (User::all() as $user) {
                $subscription_name = str_replace('_annual', '', $user->getSubscription()[0]->name ?? "free");
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

        // Routes about courses
        Route::get("/courses", function () {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            $courses = Course::all();
            foreach ($courses as $course) {
                $course->is_finished = (UserCourse::where("user_id", $user->id)
                        ->where("course_id", $course->id)
                        ->where("is_finished", true)
                        ->first() ?? false) ? true : false;
            }
            return $courses->jsonSerialize();
        });

        Route::get("courses/{course}", function (Course $course) {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            if ($user->can_view_course($course)) {
                UserCourse::firstOrCreate([
                    "user_id" => $user->id,
                    "course_id" => $course->id,
                ]);
                return response()->json($course->jsonSerialize(), 200);
            }
            return response()->json(["message" => "Courses limit reached"], 401);
        });

        Route::post("courses/{course}/finished", function (Course $course) {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            $user_course = UserCourse::where("user_id", $user->id)
                ->where("course_id", $course->id)
                ->first();
            if ($user_course) {
                if ($user_course->is_finished) {
                    return response()->json(["error" => "Course already finished."], 400);
                } else {
                    $user_course->is_finished = true;
                    $user_course->save();
                    return response()->json(["message" => "Course finished."], 200);
                }
            }
            UserCourse::create([
                "user_id" => $user->id,
                "course_id" => $course->id,
                "is_finished" => true,
            ]);
            return response()->json(["message" => "Course finished."], 200);
        });

        // Routes about formations
        Route::get("/formations", function () {
            $formations = Formation::all();
            foreach ($formations as $formation) {
                $formation->courses_count = $formation->courses->count();
                $formation->user_count = $formation->formation_users->count();
            }
            return $formations->jsonSerialize();
        });

        Route::get("/formations/{formation}", function (Formation $formation) {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            $courses = [];
            foreach ($formation->courses as $key => $user_course) {
                $courses[$key] = $user_course->course;
                $courses[$key]->is_finished = (UserCourse::where("user_id", $user->id)
                        ->where("course_id", $user_course->course->id)
                        ->where("is_finished", true)
                        ->first() ?? false) ? true : false;
            }
            $formation->formation_courses = $courses;
            return $formation->jsonSerialize();
        });

        Route::post("/formations/{formation}/take", function (Formation $formation) {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            if (FormationUser::where("user_id", $user->id)
                ->where("formation_id", $formation->id)
                ->exists()) {
                return response()->json(["error" => "Formation already taken."], 400);
            };
            FormationUser::create([
                "user_id" => $user->id,
                "formation_id" => $formation->id,
            ]);
            return response()->json(["message" => "Formation taken."], 200);
        });

        Route::post("/formations/{formation}", function (Formation $formation) {
            $user = User::where("api_key", request()->header("API_KEY"))->first();
            $formation_user = FormationUser::where("user_id", $user->id)
                ->where("formation_id", $formation->id)
                ->first();
            if (!$formation_user) {
                return response()->json(["error" => "Formation not started by user."], 400);
            } else if (!$formation_user->image && $formation_user->can_get_certification()) {
                $formation_user->create_certification_image();
            }
            return $formation_user->jsonSerialize();
        });
    });
});
