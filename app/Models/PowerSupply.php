<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PowerSupply extends Model
{
    protected $table = 'components_power_supplies';
    
    protected $fillable = [
        'name', 'price', 'wattage', 'form_factor', 'type', 'modular', 'color', 'efficiency', 'image_url'
    , 'brand'];
}
