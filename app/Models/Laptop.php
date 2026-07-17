<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $table = 'gaminglaptops';
    protected $fillable = [
        'name',
        'brand',
        'processor',
        'gpu',
        'ram',
        'storage',
        'display',
        'price',
        'image_url',
        'is_sold_out'
    ];
}
