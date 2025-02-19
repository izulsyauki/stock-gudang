<?php

use App\Http\Controllers\Api\AuthController;
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
    })->name('admin.supplier.create');

    Route::get('/stock', function () {
        return view('admin.stock');
    })->name('admin.stock');

    Route::get('/purchases', function () {
        return view('admin.purchases');
    })->name('admin.purchases');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');

    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('admin.customers');
});
