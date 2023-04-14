<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::view("/", "home");
Route::view("/admin", "admin-layout")->middleware(["auth", "admin"])->name("admin.dashboard");

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
    }
);

// Admin route
Route::group(
    ["prefix" => "admin", "middleware" => ["auth", "admin"]],
    function () {
        Route::group(["prefix" => "users", "controller" => UserController::class],
            function () {
                // List all users
                Route::get("/list", "index")->name("user.index");

                // Ban / Unban user
                Route::post("/{user}/ban", "ban")->name("user.ban");
                Route::post("/{user}/unban", "unban")->name("user.unban");
            }
        );
    }
);

Route::resource("brand", BrandController::class);
