<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PcCase extends Model
{
    protected $table = 'components_pc_cases';

    protected $fillable = [
        'name', 'price', 'max_mobo_size', 'max_gpu_length', 'type', 'color', 'side_panel', 'image_url', 'brand', 'fans_included'
    ];
}
