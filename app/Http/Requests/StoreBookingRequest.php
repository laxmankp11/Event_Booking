<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'event_id' => 'required|exists:events,id',
            'attendee_id' => 'required|exists:attendees,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->hasDuplicateBooking()) {
                $validator->errors()->add('booking', 'This attendee has already booked the event.');
            }

            if ($this->isOverCapacity()) {
                $validator->errors()->add('booking', 'The event is already at full capacity.');
            }
        });
    }

    private function hasDuplicateBooking()
    {
        return \App\Models\Booking::where([
            'event_id' => $this->event_id,
            'attendee_id' => $this->attendee_id
        ])->exists();
    }

    private function isOverCapacity()
    {
        $event = \App\Models\Event::findOrFail($this->event_id);
        return $event->bookings()->count() >= $event->capacity;
    }
}