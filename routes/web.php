<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', TripController::class . '@main')->name('main-page');

Route::post('/trips', TripController::class . '@index')->name('trips.index');
Route::get('/trips/arrival/{date}/nights/{nights}', TripController::class . '@displayTrips')->name('trips.display-all');

Route::post('/trips/book-now/arrival/{date}/nights/{nights}', TripController::class . '@displayTripToBook')->name('trips.display-single-trip');
Route::post('/trips/confirmation/arrival/{date}/nights/{nights}', TripController::class . '@processBooking')->name('trips.process-booking');

Route::post('/trips/all', TripController::class . '@displayAllBookings')->name('trips.return-all-bookings');

// Use the custom LoginController for handling login requests.
Route::post('/login', LoginController::class . '@login')->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('users', UserController::class);
