<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_type',
        'name',
        'quantity',
        'price',
        'image_url',
        'configuration',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
