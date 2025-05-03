<?php

// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\BookingController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class);
});

Route::post('/attendees', [AttendeeController::class, 'store']);
Route::post('/bookings', [BookingController::class, 'store']);