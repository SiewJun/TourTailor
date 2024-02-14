<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id', 
    'cart_id',
    'payment_method',
  ];

  public function cart()
  {
    return $this->belongsTo(Cart::class);
  }

  public function carts()
  {
    return $this->belongsToMany(Cart::class, 'payment_cart');
  }
}
