<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/supplier', function () {
        return view('admin.supplier');
    })->name('admin.supplier');

    Route::get('/supplier/add', function () {
        return view('admin.add.supplier');
    })->name('admin.add.supplier');

    Route::get('/transaction', function () {
        return view('admin.transaction');
    })->name('admin.transaction');

    Route::get('/transaction/add', function () {
        return view('admin.add.transaction');
    })->name('admin.add.transaction');

    Route::get('/purchases', function () {
        return view('admin.purchases');
    })->name('admin.purchases');

    Route::get('/purchases/add', function () {
        return view('admin.add.purchases');
    })->name('admin.add.purchases');
    
    Route::get('/products/add', function () {
        return view('admin.add.products');
    })->name('admin.add.products');

    Route::resource('/products', ProductController::class);

    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('admin.customers');
});
