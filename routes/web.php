<?php

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

Route::get('/', function () {
    return view('home');
});

// User login and logout
Route::get('/users/login', [UserController::class, "showLogin"])->middleware("guest")->name("login");
Route::post('/users/login', [UserController::class, "login"])->middleware("guest");
Route::get("/users/logout", [UserController::class, "logout"])->middleware("auth");

// User register
Route::get('/users/register', [UserController::class, "create"])->middleware("guest");
Route::post('/users', [UserController::class, "store"]);
