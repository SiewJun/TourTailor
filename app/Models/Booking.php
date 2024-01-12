<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'cart_id',
    'booking_date',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function cart()
  {
    return $this->belongsTo(Cart::class);
  }

  public function paymentCarts()
  {
    return $this->hasMany(PaymentCart::class);
  }

  public function reviews()
  {
    return $this->hasMany(Review::class);
  }
}


