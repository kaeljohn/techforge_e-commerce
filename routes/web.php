<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');

Route::get('/account/profile', function () {
    return view('account.index');
})->name('account.profile');

Route::get('/account/purchases', function () {
    return view('account.index');
})->name('account.purchases');

Route::post('/account/profile', [\App\Http\Controllers\AccountController::class, 'updateProfile'])->name('account.profile.update');

Route::get('/build-overview/{id}', function (\Illuminate\Http\Request $request, $id) {
    if ($request->query('type') === 'custom') {
        $product = \App\Models\CustombuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'])->findOrFail($id);
    } else {
        $product = \App\Models\PrebuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'])->findOrFail($id);
    }
    
    $cpus = \App\Models\Cpu::all()->map(function($i) { $i->type = 'Processor'; return $i; });
    $gpus = \App\Models\Gpu::all()->map(function($i) { $i->type = 'Video Card'; return $i; });
    $rams = \App\Models\Ram::all()->map(function($i) { $i->type = 'Memory'; return $i; });
    $storages = \App\Models\Storage::all()->map(function($i) { $i->type = 'Storage'; return $i; });
    $mobos = \App\Models\Motherboard::all()->map(function($i) { $i->type = 'Motherboard'; return $i; });
    $psus = \App\Models\PowerSupply::all()->map(function($i) { $i->type = 'Power Supply'; return $i; });
    $cases = \App\Models\PcCase::all()->map(function($i) { $i->type = 'Case'; return $i; });
    
    $allComponents = $cpus->concat($gpus)->concat($rams)->concat($storages)->concat($mobos)->concat($psus)->concat($cases);
    
    return view('build-overview', compact('product', 'allComponents'));
})->name('build-overview');

Route::get('/build-pc', function () {
    $cpus = \App\Models\Cpu::all()->map(function($i) { $i->type = 'Processor'; return $i; });
    $gpus = \App\Models\Gpu::all()->map(function($i) { $i->type = 'Video Card'; return $i; });
    $rams = \App\Models\Ram::all()->map(function($i) { $i->type = 'Memory'; return $i; });
    $storages = \App\Models\Storage::all()->map(function($i) { $i->type = 'Storage'; return $i; });
    $mobos = \App\Models\Motherboard::all()->map(function($i) { $i->type = 'Motherboard'; return $i; });
    $psus = \App\Models\PowerSupply::all()->map(function($i) { $i->type = 'Power Supply'; return $i; });
    $cases = \App\Models\PcCase::all()->map(function($i) { $i->type = 'Case'; return $i; });
    
    $allComponents = $cpus->concat($gpus)->concat($rams)->concat($storages)->concat($mobos)->concat($psus)->concat($cases);

    return view('plugins.build-pc', compact('allComponents'));
})->name('build-pc');

Route::get('/gaming-pcs', [\App\Http\Controllers\GamingPcController::class, 'index'])->name('gaming-pcs');
Route::get('/custom-pcs', [\App\Http\Controllers\CustomPcController::class, 'index'])->name('custom-pcs');
Route::get('/prebuilt-pcs', [\App\Http\Controllers\PrebuiltPcController::class, 'index'])->name('prebuilt-pcs');

Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [\App\Http\Controllers\CartController::class, 'getCount'])->name('cart.count');
