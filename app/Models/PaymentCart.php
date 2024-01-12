<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCart extends Model
{
    use HasFactory;

    protected $table = 'payment_cart';

    protected $fillable = [
        'payment_id',
        'cart_id',
        'amount',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
