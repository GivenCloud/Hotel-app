<?php

use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\Dashboard\HotelController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('hotel', HotelController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('guest', GuestController::class);
    Route::resource('room', RoomController::class);
});

require __DIR__.'/auth.php';
