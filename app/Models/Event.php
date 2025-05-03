<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id', 'title', 'country', 'capacity', 'start_time', 'end_time'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}