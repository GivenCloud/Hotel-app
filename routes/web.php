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
    Route::get('dashboard/hotel/add-services/{hotel}', [HotelController::class, 'addService'])->name('hotel.addService');
    Route::post('dashboard/hotel/add-services/{hotel}', [HotelController::class, 'storeService'])->name('hotel.storeService');
    Route::delete('dashboard/hotel/delete-services/{hotel}/{service}', [HotelController::class, 'destroyService'])->name('hotel.destroyService');
   
    Route::get('room/add-guests/{room}', [RoomController::class, 'addGuest'])->name('room.addGuest');
    Route::post('room/add-guests/{room}', [RoomController::class, 'storeGuest'])->name('room.storeGuest');
    Route::delete('room/delete-guests/{room}/{guest}', [RoomController::class, 'destroyGuest'])->name('room.destroyGuest');
   
    Route::get('guest/add-services/{guest}', [GuestController::class, 'addService'])->name('guest.addService');
    Route::post('guest/add-services/{guest}', [GuestController::class, 'storeService'])->name('guest.storeService');
    Route::delete('guest/delete-services/{guest}/{service}', [GuestController::class, 'destroyService'])->name('guest.destroyService');
    
    Route::get('guest/add-rooms/{guest}', [GuestController::class, 'addRoom'])->name('guest.addRoom');
    Route::post('guest/add-rooms/{guest}', [GuestController::class, 'storeRoom'])->name('guest.storeRoom');
    Route::delete('guest/delete-rooms/{guest}/{room}', [GuestController::class, 'destroyRoom'])->name('guest.destroyRoom');
    
    Route::get('service/add-hotels/{service}', [ServiceController::class, 'addHotel'])->name('service.addHotel');
    Route::post('service/add-hotels/{service}', [ServiceController::class, 'storeHotel'])->name('service.storeHotel');
    Route::delete('service/delete-hotels/{service}/{hotel}', [ServiceController::class, 'destroyHotel'])->name('service.destroyHotel');
    
    Route::get('service/add-guests/{service}', [ServiceController::class, 'addGuest'])->name('service.addGuest');
    Route::post('service/add-guests/{service}', [ServiceController::class, 'storeGuest'])->name('service.storeGuest');
    Route::delete('service/delete-guests/{service}/{guest}', [ServiceController::class, 'destroyGuest'])->name('service.destroyGuest');
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
