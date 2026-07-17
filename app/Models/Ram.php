<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    protected $table = 'components_rams';
    
    protected $fillable = [
        'name', 'price', 'generation', 'capacity', 'speed', 'modules', 'image_url'
    , 'brand'];
}
