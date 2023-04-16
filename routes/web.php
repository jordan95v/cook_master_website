<?php

use App\Http\Controllers\EventController;
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

//All Events
Route::get('/events', function () {
    return view('events', [
        'heading' => 'Latest Events',
        'events' => Event::all()
    ]);
});

//Single Event
Route::get('/events/{id}', function ($id) {
    return view('event', [
        'event' => Event::find($id),
        'events' => Event::all()
    ]);
});

//Show Create Form
// Route::get('/events/create', function () {
//     return view('createEvent')
// });

Route::resource('event', EventController::class);
