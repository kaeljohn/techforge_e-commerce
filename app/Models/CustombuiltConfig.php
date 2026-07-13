<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustombuiltConfig extends Model
{
    use HasFactory;

    protected $table = 'configurator_configs';
    
    protected $guarded = [];

    public function cpu() { return $this->belongsTo(Cpu::class); }
    public function gpu() { return $this->belongsTo(Gpu::class); }
    public function motherboard() { return $this->belongsTo(Motherboard::class); }
    public function ram() { return $this->belongsTo(Ram::class); }
    public function storage() { return $this->belongsTo(Storage::class); }
    public function powerSupply() { return $this->belongsTo(PowerSupply::class); }
    public function pcCase() { return $this->belongsTo(PcCase::class); }
}