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

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');

Route::get('/build-pc', function () {
    return view('plugins.build-pc');
})->name('build-pc');

Route::get('/gaming-pcs', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Product::query();

    // Category Filter
    if ($request->filled('category') && $request->category !== 'All PCs') {
        $query->where('category', $request->category);
    }

    // Price Filter
    if ($request->filled('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }
    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    // Brand Filter
    if ($request->filled('brand')) {
        $query->whereIn('brand', $request->brand);
    }

    // Processor Filter
    if ($request->filled('processor')) {
        $query->whereIn('processor', $request->processor);
    }

    // Sorting
    $sort = $request->input('sort', 'Recommended');
    switch ($sort) {
        case 'Price: Low to High':
            $query->orderBy('price', 'asc');
            break;
        case 'Price: High to Low':
            $query->orderBy('price', 'desc');
            break;
        case 'Newest Arrivals':
            $query->latest();
            break;
        case 'Customer Reviews':
            $query->orderBy('rating', 'desc');
            break;
        default:
            // Recommended (no specific sort, or by ID)
            $query->orderBy('id', 'asc');
            break;
    }

    $products = $query->get();
    
    // Accurate filter counts
    $counts = [
        'categories' => [
            'All PCs' => \App\Models\Product::count(),
            'Prebuilt Desktops' => \App\Models\Product::where('category', 'Prebuilt Desktops')->count(),
            'Custom Builds' => \App\Models\Product::where('category', 'Custom Builds')->count(),
        ],
        'brands' => [
            'TechForge Forge' => \App\Models\Product::where('brand', 'TechForge Forge')->count(),
            'ASUS ROG' => \App\Models\Product::where('brand', 'ASUS ROG')->count(),
            'MSI' => \App\Models\Product::where('brand', 'MSI')->count(),
            'Lenovo Legion' => \App\Models\Product::where('brand', 'Lenovo Legion')->count(),
        ],
        'processors' => [
            'Intel Core i9' => \App\Models\Product::where('processor', 'Intel Core i9')->count(),
            'Intel Core i7' => \App\Models\Product::where('processor', 'Intel Core i7')->count(),
            'AMD Ryzen 9' => \App\Models\Product::where('processor', 'AMD Ryzen 9')->count(),
            'AMD Ryzen 7' => \App\Models\Product::where('processor', 'AMD Ryzen 7')->count(),
        ],
    ];

    return view('gaming-pcs', compact('products', 'counts'));
})->name('gaming-pcs');

