<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustombuiltConfig;

class CustomPcController extends Controller
{
    public function index()
    {
        $configs = CustombuiltConfig::with(['intelCpu', 'amdCpu', 'gpu', 'intelMotherboard', 'amdMotherboard', 'intelRam', 'amdRam', 'storage', 'powerSupply', 'pcCase'])->get();
        $tiers = ['Core', 'Advanced', 'Extreme', 'Apex'];
        return view('pc-configurator', compact('configs', 'tiers'));
    }
}