<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. CPUs
        Schema::create('cpus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('socket'); // e.g. AM5, LGA 1700, LGA 1851
            $table->integer('tdp'); // in Watts
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 2. Motherboards
        Schema::create('motherboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('socket');
            $table->integer('form_factor'); // 4: E-ATX, 3: ATX, 2: Micro-ATX, 1: Mini-ITX
            $table->string('supported_ram_gen'); // e.g. DDR4, DDR5
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 3. RAMs
        Schema::create('rams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('generation'); // DDR4, DDR5
            $table->integer('capacity'); // e.g. 16, 32 (GB)
            $table->integer('speed'); // e.g. 3200, 6000 (MHz)
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 4. GPUs
        Schema::create('gpus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('tdp'); // in Watts
            $table->integer('length_mm'); // in mm
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 5. Power Supplies
        Schema::create('power_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('wattage'); // in Watts
            $table->string('form_factor'); // ATX, SFX
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 6. PC Cases
        Schema::create('pc_cases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('max_mobo_size'); // 4: E-ATX, 3: ATX, 2: Micro-ATX, 1: Mini-ITX
            $table->integer('max_gpu_length'); // in mm
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pc_cases');
        Schema::dropIfExists('power_supplies');
        Schema::dropIfExists('gpus');
        Schema::dropIfExists('rams');
        Schema::dropIfExists('motherboards');
        Schema::dropIfExists('cpus');
    }
};
