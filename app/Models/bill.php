<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_id',
        'status',
    ];


    protected $hidden = [
        'updated_at'
    ];

    public function getFormattedTotalPriceAttribute()
    {
        $cartprice = $this->cart->totalPrice ?? 0;
        $tax = floor($cartprice * 0.03);
        $delivery = 5000;
        $price = $cartprice + $tax + $delivery;
        return $price;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }
}
