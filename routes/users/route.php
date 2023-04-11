<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(
    function () {
    }
);

Route::prefix("users")->group(
    function () {
        Route::controller(UserController::class)->group(
            function () {
                // List all users
                Route::get("/list", "index")->middleware(["auth", "admin"]);

                // User registration
                Route::get('/register', "create")->middleware("guest")->name("register");
                Route::post('/', "store")->name("store-user");

                //User modification
                Route::get('/edit', "edit")->middleware(["auth", "verified"])->name("edit-user");
                Route::put('/', "update")->middleware("auth")->name("update-user");
                Route::delete('/{user}', "destroy")->middleware("auth")->name("destroy-user");
            }
        );

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
