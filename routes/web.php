<?php

use App\Http\Controllers\AuthController;
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

// User login and logout
Route::get('/login', [AuthController::class, "showLogin"])->middleware("guest")->name("login");
Route::post('/login', [AuthController::class, "login"])->middleware("guest");
Route::get("/logout", [AuthController::class, "logout"])->middleware("auth");

// User register
Route::get('/register', [UserController::class, "create"])->middleware("guest");
Route::post('/users', [UserController::class, "store"]);
