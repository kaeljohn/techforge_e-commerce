<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');

Route::get('/build-pc', function () {
    return view('plugins.build-pc');
})->name('build-pc');

Route::get('/gaming-pcs', function () {
    return view('gaming-pcs');
})->name('gaming-pcs');

