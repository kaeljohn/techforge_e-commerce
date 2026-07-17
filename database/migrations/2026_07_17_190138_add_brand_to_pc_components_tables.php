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
        $tables = [
            'components_cpus',
            'components_gpus',
            'components_motherboards',
            'components_rams',
            'components_storages',
            'components_coolers',
            'components_pc_cases',
            'components_chasisfan',
            'components_power_supplies',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->string('brand')->nullable()->after('name');
            });
        }

        $models = [
            \App\Models\Cpu::class,
            \App\Models\Gpu::class,
            \App\Models\Motherboard::class,
            \App\Models\Ram::class,
            \App\Models\Storage::class,
            \App\Models\Cooler::class,
            \App\Models\PcCase::class,
            \App\Models\ChasisFan::class,
            \App\Models\PowerSupply::class,
        ];

        $knownMultiWordBrands = ['Lian Li', 'Fractal Design', 'Cooler Master', 'Western Digital', 'Be Quiet!'];

        foreach ($models as $modelClass) {
            foreach ($modelClass::all() as $item) {
                $nameStr = $item->name ?? '';
                $brand = null;
                
                foreach ($knownMultiWordBrands as $multiBrand) {
                    if (stripos($nameStr, $multiBrand) === 0) {
                        $brand = $multiBrand;
                        break;
                    }
                }
                
                if (!$brand) {
                    $brand = explode(' ', trim($nameStr))[0] ?? null;
                }

                if ($brand) {
                    \Illuminate\Support\Facades\DB::table((new $modelClass)->getTable())
                        ->where('id', $item->id)
                        ->update(['brand' => $brand]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'components_cpus',
            'components_gpus',
            'components_motherboards',
            'components_rams',
            'components_storages',
            'components_coolers',
            'components_pc_cases',
            'components_chasisfan',
            'components_power_supplies',
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('brand');
            });
        }
    }
};
