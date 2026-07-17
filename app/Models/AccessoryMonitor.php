<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessoryMonitor extends Model
{
    use HasFactory;
    
    protected $table = 'accessories_monitors';
    protected $guarded = [];
}
