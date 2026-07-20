<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $prebuiltPcs = \App\Models\PrebuiltConfig::with(['cpu', 'gpu', 'ram', 'storage', 'powerSupply'])->take(6)->get();
    $customConfigs = \App\Models\CustombuiltConfig::with(['intelCpu', 'amdCpu', 'gpu', 'intelRam', 'amdRam', 'storage', 'powerSupply'])->take(4)->get();
    return view('welcome', compact('prebuiltPcs', 'customConfigs'));
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
    return view('account.index', [
        'paymentMethods' => \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->paymentMethods()->orderBy('is_default', 'desc')->get() : []
    ]);
})->name('account.profile');

Route::get('/account/purchases', function () {
    return view('account.index', [
        'paymentMethods' => \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->paymentMethods()->orderBy('is_default', 'desc')->get() : []
    ]);
})->name('account.purchases');

Route::post('/account/profile', [\App\Http\Controllers\AccountController::class, 'updateProfile'])->name('account.profile.update');

// Payment Methods Routes
Route::post('/account/payment-methods/card', [\App\Http\Controllers\PaymentMethodController::class, 'storeCard'])->name('account.payment-methods.store-card');
Route::post('/account/payment-methods/bank', [\App\Http\Controllers\PaymentMethodController::class, 'storeBank'])->name('account.payment-methods.store-bank');
Route::delete('/account/payment-methods/{paymentMethod}', [\App\Http\Controllers\PaymentMethodController::class, 'destroy'])->name('account.payment-methods.destroy');
Route::post('/account/payment-methods/{paymentMethod}/update', [\App\Http\Controllers\PaymentMethodController::class, 'update'])->name('account.payment-methods.update');
Route::post('/account/payment-methods/{paymentMethod}/default', [\App\Http\Controllers\PaymentMethodController::class, 'setDefault'])->name('account.payment-methods.set-default');

// Address Routes
Route::post('/account/addresses', [\App\Http\Controllers\AddressController::class, 'store'])->name('account.addresses.store');
Route::put('/account/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'update'])->name('account.addresses.update');
Route::delete('/account/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'destroy'])->name('account.addresses.destroy');
Route::post('/account/addresses/{address}/default', [\App\Http\Controllers\AddressController::class, 'setDefault'])->name('account.addresses.set-default');
Route::get('/configurator-overview/{id}', function ($id) {
    $product = \App\Models\CustombuiltConfig::with(['intelCpu', 'amdCpu', 'gpu', 'intelMotherboard', 'amdMotherboard', 'intelRam', 'amdRam', 'storage', 'powerSupply', 'pcCase', 'cooler'])->findOrFail($id);
    
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

Route::get('/custompc-overview/{id}', function ($id) {
    if (str_starts_with($id, 'custom-pc-') || str_starts_with($id, 'custom_')) {
        $configuration = null;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartItem = \App\Models\CartItem::where('product_id', $id)->first();
            if ($cartItem) $configuration = $cartItem->configuration;
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) $configuration = $cart[$id]['configuration'] ?? null;
        }
        
        if (!$configuration) {
            return redirect('/cart')->with('error', 'This custom PC build is from an older session and its configuration data was lost. Please remove it and build a new one.');
        }
        
        $config = json_decode($configuration, true);
        $product = new \App\Models\CustombuiltConfig();
        $product->id = $id;
        $product->name = 'Custom PC Build';
        
        // Sum total from config
        $total = 0;
        foreach($config as $part) {
            if (isset($part['price'])) $total += floatval($part['price']);
        }
        $product->price = $total;
        
        if (isset($config['Processor'])) $product->setRelation('intelCpu', new \App\Models\Cpu((array)$config['Processor']));
        if (isset($config['Motherboard'])) $product->setRelation('intelMotherboard', new \App\Models\Motherboard((array)$config['Motherboard']));
        if (isset($config['Memory'])) $product->setRelation('intelRam', new \App\Models\Ram((array)$config['Memory']));
        if (isset($config['Video Card'])) $product->setRelation('gpu', new \App\Models\Gpu((array)$config['Video Card']));
        if (isset($config['Primary Storage'])) $product->setRelation('storage', new \App\Models\Storage((array)$config['Primary Storage']));
        if (isset($config['Power Supply'])) $product->setRelation('powerSupply', new \App\Models\PowerSupply((array)$config['Power Supply']));
        if (isset($config['Case'])) $product->setRelation('pcCase', new \App\Models\PcCase((array)$config['Case']));
        if (isset($config['Cooling'])) $product->setRelation('cooler', new \App\Models\Cooler((array)$config['Cooling']));
        
        return view('custompc-overview', compact('product'));
    }

    $product = \App\Models\CustombuiltConfig::with(['intelCpu', 'amdCpu', 'gpu', 'intelMotherboard', 'amdMotherboard', 'intelRam', 'amdRam', 'storage', 'powerSupply', 'pcCase', 'cooler'])->findOrFail($id);
    return view('custompc-overview', compact('product'));
})->name('custompc-overview');


Route::get('/laptop-overview/{id}', function ($id) {
    $product = \App\Models\Laptop::findOrFail($id);
    return view('laptop-overview', compact('product'));
})->name('laptop-overview');

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
Route::get('/gaming-laptops', [\App\Http\Controllers\LaptopController::class, 'index'])->name('gaming-laptops');
Route::get('/store/accessories', [\App\Http\Controllers\AccessoryController::class, 'index'])->name('store.accessories');
Route::get('/store/monitors', [\App\Http\Controllers\AccessoryController::class, 'monitors'])->name('store.monitors');
Route::get('/store/pc-parts', [\App\Http\Controllers\PcPartController::class, 'index'])->name('store.pc-parts');
Route::get('/forge-store', function () {
    $accessories = collect([
        \App\Models\AccessoryKeyboard::latest()->first(),
        \App\Models\AccessoryHeadset::latest()->first(),
        \App\Models\AccessoryMouse::latest()->first(),
        \App\Models\AccessoryMousePad::latest()->first(),
        \App\Models\AccessorySpeakerSystem::latest()->first(),
        \App\Models\AccessoryKeyboardAccessory::latest()->first()
    ])->filter()->map(function ($item) {
        $item->category = match(class_basename($item)) {
            'AccessoryKeyboard' => 'Keyboard',
            'AccessoryHeadset' => 'Headset',
            'AccessoryMouse' => 'Mouse',
            'AccessoryMousePad' => 'Mouse Pad',
            'AccessorySpeakerSystem' => 'Audio',
            'AccessoryKeyboardAccessory' => 'Keyboard Mod',
            default => 'Accessory'
        };
        $item->rating = 5;
        $item->reviews = rand(50, 200);
        $item->sale = true;
        $item->originalPrice = $item->price * 1.25;
        return $item;
    });

    $monitors = \App\Models\AccessoryMonitor::latest()->take(6)->get()->map(function ($item) {
        $item->category = 'Monitor';
        $item->rating = 5;
        $item->reviews = rand(20, 300);
        $item->sale = true;
        $item->originalPrice = $item->price * 1.2;
        return $item;
    });

    $pcParts = collect([
        \App\Models\Cpu::latest()->first(),
        \App\Models\Gpu::latest()->first(),
        \App\Models\Motherboard::latest()->first(),
        \App\Models\Ram::latest()->first(),
        \App\Models\Storage::latest()->first(),
        \App\Models\PcCase::latest()->first(),
    ])->filter()->map(function ($item) {
        $item->category = match(class_basename($item)) {
            'Cpu' => 'Processor',
            'Gpu' => 'Video Card',
            'Motherboard' => 'Motherboard',
            'Ram' => 'Memory',
            'Storage' => 'Storage',
            'PcCase' => 'Case',
            default => 'PC Part'
        };
        $item->rating = 5;
        $item->reviews = rand(15, 200);
        $item->sale = true;
        $item->originalPrice = $item->price * 1.15;
        return $item;
    });

    return view('forge-store', compact('accessories', 'monitors', 'pcParts'));
})->name('forge-store');
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/api/search/suggestions', [\App\Http\Controllers\SearchController::class, 'suggestions'])->name('search.suggestions');

Route::get('/cart/checkout-redirect', function () {
    session()->put('redirect_after_auth', route('cart'));
    return redirect()->route('login');
})->name('cart.checkout.redirect');

Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update-quantity', [\App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::delete('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [\App\Http\Controllers\CartController::class, 'getCount'])->name('cart.count');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{id}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
});
