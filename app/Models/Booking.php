<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['event_id', 'attendee_id'];

    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }

    public function attendee()
    {
        return $this->belongsTo(\App\Models\Attendee::class);
    }
}