<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChasisFan extends Model
{
    protected $table = 'components_chasisfan';

    protected $fillable = [
        'name', 'price', 'size', 'rpm', 'airflow', 'noise_level', 'color', 'rgb', 'image_url'
    , 'brand'];
}
