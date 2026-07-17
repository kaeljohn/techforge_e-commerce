<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessoryMouse extends Model
{
    use HasFactory;
    
    protected $table = 'accessories_mice';
    protected $guarded = [];
}
