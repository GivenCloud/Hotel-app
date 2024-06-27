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