<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustombuiltConfig;

class CustomPcController extends Controller
{
    public function index()
    {
        $configs = CustombuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'])->get();
        $tiers = ['Entry Level', 'Mainstream', 'Enthusiast'];
        return view('custom-pcs', compact('configs', 'tiers'));
    }
}