<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\StockTransactionController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::middleware(['is_admin'])->group(function () {
        Route::get('/products/add', [ProductController::class, 'create'])->name('admin.add.products');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/supplier/add', [SupplierController::class, 'create'])->name('admin.add.supplier');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

        Route::get('/transaction/add', [StockTransactionController::class, 'create'])->name('admin.add.transaction');
        Route::post('/transaction', [StockTransactionController::class, 'store'])->name('transaction.store');
        Route::get('/transaction/{transaction}/edit', [StockTransactionController::class, 'edit'])->name('transaction.edit');
        Route::put('/transaction/{transaction}', [StockTransactionController::class, 'update'])->name('transaction.update');
        Route::delete('/transaction/{transaction}', [StockTransactionController::class, 'destroy'])->name('transaction.destroy');

        Route::get('/purchases/add', [PurchaseController::class, 'create'])->name('admin.add.purchases');
        Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
        Route::get('/purchases/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
        Route::put('/purchases/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');
        Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');

        Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/transaction', [StockTransactionController::class, 'index'])->name('transaction.index');
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
});
