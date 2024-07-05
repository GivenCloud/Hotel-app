<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('hotel', HotelController::class)->except(['create', 'edit']);
Route::resource('room', RoomController::class)->except(['create', 'edit']);
Route::resource('guest', GuestController::class)->except(['create', 'edit']);
Route::resource('category', CategoryController::class)->except(['create', 'edit']);
Route::resource('type', TypeController::class)->except(['create', 'edit']);
Route::resource('service', ServiceController::class)->except(['create', 'edit']);

Route::get('service/search/{name}', [ServiceController::class, 'search']);
Route::get('service/{service}/category', [ServiceController::class, 'getCategory']);
Route::get('service/{service}/hotels', [ServiceController::class, 'getHotels']);
Route::get('service/{service}/guests', [ServiceController::class, 'getGuests']);


Route::get('hotel/search/{name}', [HotelController::class, 'search']);
Route::get('hotel/{hotel}/rooms', [HotelController::class, 'getRooms']);
Route::get('hotel/{hotel}/services', [HotelController::class, 'getServices']);

Route::get('room/search/{number}', [RoomController::class, 'search']);
Route::get('room/{room}/hotel', [RoomController::class, 'getHotel']);
Route::get('room/{room}/guests', [RoomController::class, 'getGuests']);
Route::get('room/{room}/type', [RoomController::class, 'getType']);

Route::get('type/search/{name}', [TypeController::class, 'search']);
Route::get('type/{type}/rooms', [TypeController::class, 'getRooms']);

Route::get('category/search/{name}', [CategoryController::class, 'search']);
Route::get('category/{category}/services', [CategoryController::class, 'getServices']);

Route::get('guest/search/{name}', [GuestController::class, 'search']);
Route::get('guest/{guest}/rooms', [GuestController::class, 'getRooms']);
Route::get('guest/{guest}/services', [GuestController::class, 'getServices']);