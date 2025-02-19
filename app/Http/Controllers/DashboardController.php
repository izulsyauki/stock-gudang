<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::count();
        $customers = Customer::count();
        $products = Product::count();
        $purchases = Purchase::count();
        $stock_transactions = StockTransaction::count();

        return view('admin.dashboard', compact('suppliers', 'customers', 'products', 'purchases', 'stock_transactions'));
    }
}
