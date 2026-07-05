<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpu;
use App\Models\Motherboard;
use App\Models\Ram;
use App\Models\Gpu;
use App\Models\PowerSupply;
use App\Models\PcCase;

class ConfiguratorController extends Controller
{
    public function index()
    {
        $cpus = Cpu::all();
        $motherboards = Motherboard::all();
        $rams = Ram::all();
        $gpus = Gpu::all();
        $powerSupplies = PowerSupply::all();
        $cases = PcCase::all();

        return view('configurator', compact('cpus', 'motherboards', 'rams', 'gpus', 'powerSupplies', 'cases'));
    }
}
