<?php

use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\Dashboard\HotelController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\TypeController;
use App\Http\Controllers\Web\BlogController;
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
    return view('bienvenido');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'admin']], function () {
    Route::get('hotel/search', [HotelController::class, 'search'])->name('hotel.search');
    Route::get('room/search', [RoomController::class, 'search'])->name('room.search');
    Route::get('service/search', [ServiceController::class, 'search'])->name('service.search');
    Route::get('guest/search', [GuestController::class, 'search'])->name('guest.search');
    Route::get('category/search', [CategoryController::class, 'search'])->name('category.search');
    Route::get('type/search', [TypeController::class, 'search'])->name('type.search');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'admin']], function () {
    Route::resources([
        'hotel' => HotelController::class,
        'room' => RoomController::class,
        'service' => ServiceController::class,
        'guest' => GuestController::class,
        'category' => CategoryController::class,
        'type' => TypeController::class
    ]);
});

Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('/', 'index');
    });
});



require __DIR__.'/auth.php';
