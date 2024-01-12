<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'booking_id', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(); // 'withDefault' sets a default user if the associated user is deleted
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class)->withDefault(); // 'withDefault' sets a default booking if the associated booking is deleted
    }
}

