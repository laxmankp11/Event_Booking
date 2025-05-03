<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendeeRequest;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    public function store(StoreAttendeeRequest $request)
    {
        $attendee = Attendee::create($request->validated());
        return new AttendeeResource($attendee);
    }
}