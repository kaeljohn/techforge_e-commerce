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

// Social Auth Routes
Route::get('/auth/complete-registration', [\App\Http\Controllers\Auth\SocialAuthController::class, 'completeRegistration'])->name('social.complete-registration');
Route::post('/auth/complete-registration', [\App\Http\Controllers\Auth\SocialAuthController::class, 'processRegistration'])->name('social.process-registration');
Route::get('/auth/{provider}', [\App\Http\Controllers\Auth\SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [\App\Http\Controllers\Auth\SocialAuthController::class, 'callback'])->name('social.callback');

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

Route::get('/configurator-overview/{id}', function ($id) {
    $product = \App\Models\CustombuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase', 'cooler'])->findOrFail($id);
    
    $cpus = \App\Models\Cpu::all()->map(function($i) { $i->component_category = 'Processor'; return $i; });
    $gpus = \App\Models\Gpu::all()->map(function($i) { $i->component_category = 'Video Card'; return $i; });
    $rams = \App\Models\Ram::all()->map(function($i) { $i->component_category = 'Memory'; return $i; });
    $storages = \App\Models\Storage::all()->map(function($i) { $i->storage_type = $i->type; $i->component_category = 'Storage'; return $i; });
    $mobos = \App\Models\Motherboard::all()->map(function($i) { $i->component_category = 'Motherboard'; return $i; });
    $psus = \App\Models\PowerSupply::all()->map(function($i) { $i->component_category = 'Power Supply'; return $i; });
    $cases = \App\Models\PcCase::all()->map(function($i) { $i->component_category = 'Case'; return $i; });
    $coolers = \App\Models\Cooler::all()->map(function($i) { $i->component_category = 'Cooling'; return $i; });
    $caseFans = \App\Models\ChasisFan::all()->map(function($i) { $i->component_category = 'Case Fan'; return $i; });
    
    $allComponents = $cpus->concat($gpus)->concat($rams)->concat($storages)->concat($mobos)->concat($psus)->concat($cases)->concat($coolers)->concat($caseFans);
    
    return view('configurator-overview', compact('product', 'allComponents'));
})->name('configurator-overview');

Route::get('/prebuilt-overview/{id}', function ($id) {
    $product = \App\Models\PrebuiltConfig::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'])->findOrFail($id);
    return view('prebuilt-overview', compact('product'));
})->name('prebuilt-overview');

Route::get('/build-pc', function () {
    $cpus = \App\Models\Cpu::all()->map(function($i) { $i->type = 'Processor'; return $i; });
    $gpus = \App\Models\Gpu::all()->map(function($i) { $i->type = 'Video Card'; return $i; });
    $rams = \App\Models\Ram::all()->map(function($i) { $i->type = 'Memory'; return $i; });
    $storages = \App\Models\Storage::all()->map(function($i) { $i->storage_type = $i->type; $i->type = 'Storage'; return $i; });
    $mobos = \App\Models\Motherboard::all()->map(function($i) { $i->type = 'Motherboard'; return $i; });
    $psus = \App\Models\PowerSupply::all()->map(function($i) { $i->type = 'Power Supply'; return $i; });
    $cases = \App\Models\PcCase::all()->map(function($i) { $i->type = 'Case'; return $i; });
    $coolers = \App\Models\Cooler::all()->map(function($i) { $i->type = 'Cooling'; return $i; });
    $caseFans = \App\Models\ChasisFan::all()->map(function($i) { $i->type = 'Case Fan'; return $i; });

    $allComponents = $cpus->concat($gpus)->concat($rams)->concat($storages)->concat($mobos)->concat($psus)->concat($cases)->concat($coolers)->concat($caseFans);

    return view('plugins.build-pc', compact('allComponents'));
})->name('build-pc');

Route::get('/pc-configurator', [\App\Http\Controllers\CustomPcController::class, 'index'])->name('pc-configurator');
Route::get('/prebuilt-pcs', [\App\Http\Controllers\PrebuiltPcController::class, 'index'])->name('prebuilt-pcs');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/api/search/suggestions', [\App\Http\Controllers\SearchController::class, 'suggestions'])->name('search.suggestions');

Route::get('/cart/checkout-redirect', function () {
    session()->put('redirect_after_auth', route('cart'));
    return redirect()->route('login');
})->name('cart.checkout.redirect');

Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [\App\Http\Controllers\CartController::class, 'getCount'])->name('cart.count');
