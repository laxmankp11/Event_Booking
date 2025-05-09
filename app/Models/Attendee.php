<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = ['name', 'email'];

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}