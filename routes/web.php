<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\EquipedController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
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
Route::get("/lang/{lang}", function (string $lang) {
    Session::put("locale", $lang);
    return redirect()->back();
})->whereIn("lang", ["fr", "en", "es", "kr"])->name("lang.update");

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
                Route::put('/', "update")->middleware("auth")->name("user.update");
                Route::delete('/{user}', "destroy")->middleware("auth")->name("user.destroy");

                // User invoices
                Route::get("/invoices", "invoices")->middleware("auth")->name("user.invoices");
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
    }
);

// Brand
Route::resource("brand", BrandController::class)->middleware("auth");

// Product
Route::resource("product", ProductController::class)->middleware("auth");

// Order and store
Route::post("/order/{product}", [OrderController::class, 'store'])->middleware("auth")->name("order.store");
Route::post("/order/{order}/delete", [OrderController::class, 'destroy'])->middleware("auth")->name("order.destroy");
Route::get("/store", [ProductController::class, "storeIndex"])->name("store");
Route::get("/basket", [OrderController::class, "show"])->name("order.show");

// Event
Route::get("/events/all", [EventController::class, "admin_index"])->middleware("auth")->name("events.listing");
Route::resource('events', EventController::class);

// Room
Route::resource('room', RoomController::class);

// Auth route
Route::group(["middleware" => ["auth"]], function () {
    // Equipment and equip room
    Route::resource('equipment', EquipmentController::class);
    Route::post('/equiped/select', [EquipedController::class, 'select'])->name('equiped.select');
    Route::resource('equiped', EquipedController::class, ["except" => ["edit"]]);
    Route::get('/equiped/{room}/edit', [EquipedController::class, 'edit'])->name('equiped.edit');

    // Order
    Route::post("/payment", [OrderController::class, "pay"])->name("order.pay");

    // Event subscription
    Route::post('/events/{event}/subscribe', [EventController::class, 'subscribe'])->name('event.subscribe');
    Route::post('/events/{event}/unsubscribe', [EventController::class, 'unsubscribe'])->name('event.unsubscribe');
});
