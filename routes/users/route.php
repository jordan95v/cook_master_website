<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(
    function () {
        // User register
        Route::get('/register', "create")->middleware("guest");
        Route::post('/users', "store");

        //User Modification
        Route::get('/users/edit', "edit")->middleware(["auth", "verified"]);
        Route::put('/users/{user}', "update")->middleware("auth");
        Route::delete('/users/{user}', "destroy")->middleware("auth");
    }
);

Route::controller(AuthController::class)->group(
    function () {
        // User login and logout
        Route::get('/login', "showLogin")->middleware("guest")->name("login");
        Route::post('/login', "login")->middleware("guest");
        Route::get("/logout", "logout")->middleware("auth");


        // Verify email adress
        Route::get('/email/verify', "notice")->middleware('auth')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', "verify")->middleware(['auth', 'signed'])->name('verification.verify');
        Route::get("/email/resend", "resendEmail")->middleware(["auth", "throttle:6,1"])->name("verification.send");
    }
);
