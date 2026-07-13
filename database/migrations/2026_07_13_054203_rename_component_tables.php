<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('cpus', 'component_cpus');
        Schema::rename('gpus', 'component_gpus');
        Schema::rename('motherboards', 'component_motherboards');
        Schema::rename('rams', 'component_rams');
        Schema::rename('storages', 'component_storages');
        Schema::rename('power_supplies', 'component_power_supplies');
        Schema::rename('pc_cases', 'component_pc_cases');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('component_cpus', 'cpus');
        Schema::rename('component_gpus', 'gpus');
        Schema::rename('component_motherboards', 'motherboards');
        Schema::rename('component_rams', 'rams');
        Schema::rename('component_storages', 'storages');
        Schema::rename('component_power_supplies', 'power_supplies');
        Schema::rename('component_pc_cases', 'pc_cases');
    }
};
