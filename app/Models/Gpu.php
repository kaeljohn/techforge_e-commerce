<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    protected $table = 'components_gpus';
    
    protected $fillable = [
        'name', 'price', 'tdp', 'length_mm', 'chipset', 'memory', 'boost_clock', 'color', 'image_url'
    ];
}
