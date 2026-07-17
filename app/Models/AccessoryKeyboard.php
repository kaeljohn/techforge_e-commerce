<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessoryKeyboard extends Model
{
    use HasFactory;
    
    protected $table = 'accessories_keyboards';
    protected $guarded = [];
}
