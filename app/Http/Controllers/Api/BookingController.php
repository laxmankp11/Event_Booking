<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create($request->validated());
        return new BookingResource($booking);
    }
}