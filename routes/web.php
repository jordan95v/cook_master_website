<?php

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

Route::get('/events', function () {
    return view('events', [
        'heading' => 'Latest Events',
        'events' => Event::all()
    ]);
});

Route::get('/events/{id}', function ($id) {
    return view('event', [
        'event' => Event::find($id)
    ]);
});
