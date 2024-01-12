<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'package_id',
    'selected_pax',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function package()
  {
    return $this->belongsTo(Package::class);
  }

  public function carts()
  {
    return $this->hasMany(Cart::class);
  }

  public function paymentCart()
  {
    return $this->hasOne(PaymentCart::class);
  }
}
