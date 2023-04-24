<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;
use App\Models\Equipment;
use App\Models\Event;
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
require "users/route.php";



Route::resource('events', EventController::class);
Route::resource('equipment', EquipmentController::class);
