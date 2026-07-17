<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooler extends Model
{
    use HasFactory;

    protected $table = 'components_coolers';

    protected $fillable = [
        'name',
        'price',
        'fan_rpm',
        'noise_level',
        'color',
        'radiator_size',
        'image_url',
        'brand'
    ];
}
