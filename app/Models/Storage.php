<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'components_storages';

    protected $fillable = [
        'name', 'price', 'type', 'capacity', 'cache', 'form_factor', 'interface', 'image_url'
    , 'brand'];
}
