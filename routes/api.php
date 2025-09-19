<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PropertyController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\HostController;
use App\Http\Controllers\API\AmenityController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\AvailabilityController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\FavoriteController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('change-password', [AuthController::class, 'changePassword'])->middleware('auth:sanctum');


Route::get('/properties', [PropertyController::class, 'index']);
Route::post('/properties', [PropertyController::class, 'store']);
Route::get('/properties/{id}', [PropertyController::class, 'show']);
Route::put('/properties/{id}', [PropertyController::class, 'update']);
Route::delete('/properties/{id}', [PropertyController::class, 'destroy']);


Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);


Route::get('/hosts/{id}/properties', [HostController::class, 'properties']);
Route::post('/hosts', [HostController::class, 'store']);
Route::get('/hosts/{id}', [HostController::class, 'show']);


Route::get('/amenities', [AmenityController::class, 'index']);
Route::post('/amenities', [AmenityController::class, 'store']);
Route::get('/amenities/{id}', [AmenityController::class, 'show']);
Route::delete('/amenities/{id}', [AmenityController::class, 'destroy']);


Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::put('/bookings/{id}', [BookingController::class, 'update']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);


Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);


Route::get('/availabilities', [AvailabilityController::class, 'index']);
Route::post('rooms/{room_id}/availabilities', [AvailabilityController::class, 'store']);
Route::get('rooms/{room_id}/availabilities', [AvailabilityController::class, 'show']);
Route::put('/availabilities/{id}', [AvailabilityController::class, 'update']);
Route::delete('/availabilities/{id}', [AvailabilityController::class, 'destroy']);


Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);


Route::get('/favorites', [FavoriteController::class, 'index']);
Route::post('/favorites', [FavoriteController::class, 'store']);
Route::get('/favorites/{id}', [FavoriteController::class, 'show']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);