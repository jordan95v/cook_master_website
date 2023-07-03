<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EquipedController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// No controller route
Route::view("/", "home");

// Route to change the language
Route::get("/lang/{lang}", function (string $lang) {
    Session::put("locale", $lang);
    return redirect()->back();
})->whereIn("lang", ["fr", "en", "es", "kr"])->name("lang.update");

// Store
Route::get("/store", [ProductController::class, "storeIndex"])->name("store");

// Courses index
Route::get("/courses/all", [CourseController::class, "all"])->name("courses.all");

// Users Route
Route::prefix("users")->group(
    function () {
        // List route using UserController
        Route::controller(UserController::class)->group(
            function () {
                // User registration
                Route::get('/register', "create")->middleware("guest")->name("register");
                Route::post('/', "store")->name("user.store");

                // User modification
                Route::get('/edit', "edit")->middleware(["auth", "verified"])->name("user.edit");

                Route::middleware("auth")->group(
                    function () {
                        Route::put('/', "update")->name("user.update");
                        Route::delete('/{user}', "destroy")->name("user.destroy");

                        // User invoices
                        Route::get("/invoices", "invoices")->name("user.invoices");

                        // User planning
                        Route::get("/planning", "planning")->name("user.planning");

                        // User finished courses
                        Route::get("/finished-courses", "finished_course")->name("user.finished-courses");

                        // Taken formation
                        Route::get("/formations", "formations")->name("user.formations");

                        // User home courses request
                        Route::get("/home-courses", "home_courses")->name("user.home-courses");
                    }
                );
            }
        );

        // List route using AuthController
        Route::controller(AuthController::class)->group(
            function () {
                // User login and logout
                Route::get('/login', "showLogin")->middleware("guest")->name("show-login");
                Route::post('/login', "login")->middleware("guest")->name("login");;
                Route::get("/logout", "logout")->middleware("auth")->name("logout");

                // Verify email adress
                Route::get('/email/verify', "notice")->middleware('auth')->name('verification.notice');
                Route::get('/email/verify/{id}/{hash}', "verify")->middleware(['auth', 'signed'])->name('verification.verify');
                Route::get("/email/resend", "resendEmail")->middleware(["auth", "throttle:6,1"])->name("verification.send");
            }
        );

        // List route using SubscriptionController
        Route::group(["controller" => SubscriptionController::class, "middleware" => ["auth"]], function () {
            Route::get("/subscription/{plan?}", "showSubscription")->whereIn("plan", ["starter", "pro"])->name("subscription.show");
            Route::post("/subscription", "subscribe")->name("subscription.subscribe");
            Route::post("/subscription/resume", "resume")->middleware("sub")->name("subscription.resume");
            Route::delete("/subscription/cancel", "cancel")->middleware("sub")->name("subscription.cancel");
        });
    }
);

// Admin route
Route::group(
    ["prefix" => "admin", "middleware" => ["auth", "admin"]],
    function () {
        Route::group(
            ["prefix" => "users", "controller" => UserController::class],
            function () {
                // List all users
                Route::get("/", "index")->name("user.index");

                // Ban / Unban user
                Route::post("/{user}/manage-ban", "manage_ban")->name("user.manage-ban");

                // Promote / Demote user
                Route::put("/{user}/manage-admin", "manage_admin")->name("user.manage-admin");

                // Promote service provider
                Route::put("/{user}/manage-provider", "manage_service_provider")->name("user.manage-service-provider");
            }
        );
        Route::get("/planning", [EventController::class, "planning"])->name("events.planning");
    }
);

// Auth route
Route::group(["middleware" => ["auth"]], function () {
    // Brand
    Route::resource("brand", BrandController::class);

    // Product
    Route::resource("product", ProductController::class);
    Route::resource("product/comment", ProductCommentController::class, ["except" => ["index", "show", "update", "edit", "create"]]);

    // Courses
    Route::resource('courses', CourseController::class, ["except" => ["show"]]);
    Route::get('/courses/{course}/', [CourseController::class, 'show'])->name('courses.show')->middleware('courses');
    Route::post("/courses/{course}/finish", [CourseController::class, "end"])->name("courses.finish");

    // Formation
    Route::get("/formation/list", [FormationController::class, "list_index"])->name("formation.list");
    Route::post("formation/{formation}/take", [FormationController::class, "take"])->name("formation.take");
    Route::resource('formation', FormationController::class);
    Route::get("/formation/{formation}/add-courses", [FormationController::class, "add_courses"])->name("formation.add_courses");
    Route::post("/formation/{formation}/add-courses", [FormationController::class, "store_courses"])->name("formation.store_courses");
    Route::post("/formation/{formation}/get-certification", [FormationController::class, "get_certification"])->name("formation.get_certification");

    // Room
    Route::resource('room', RoomController::class);

    // Event
    Route::get("/events/all", [EventController::class, "admin_index"])->name("events.listing");
    Route::resource('events', EventController::class);

    // Equipment
    Route::resource('equipment', EquipmentController::class);
    Route::get('/equiped/{room}/edit', [EquipedController::class, 'edit'])->name('equiped.edit');
    Route::post('/equiped/select', [EquipedController::class, 'select'])->name('equiped.select');
    Route::resource('equiped', EquipedController::class, ["except" => ["edit"]]);

    // Reservation for user
    Route::resource('reservation', ReservationController::class, ["except" => ["edit", "update", "show"]]);


    // Order
    Route::group(["controller" => OrderController::class], function () {
        Route::post("/payment", "pay")->name("order.pay");
        Route::post("/order/{product}", "store")->name("order.store");
        Route::post("/order/{order}/delete", "destroy")->name("order.destroy");
        Route::get("/basket", "show")->name("order.show");
    });

    // Event subscription
    Route::post('/events/{event}/subscribe', [EventController::class, 'subscribe'])->name('event.subscribe');
    Route::post('/events/{event}/unsubscribe', [EventController::class, 'unsubscribe'])->name('event.unsubscribe');

    //Reservation
    Route::post('/reservation/{reservation}/reject', [ReservationController::class, 'reject_reservation'])->name('reservation.reject');
    Route::post('/reservation/{reservation}/assign', [ReservationController::class, 'assign_chef'])->name('reservation.assign');
});
