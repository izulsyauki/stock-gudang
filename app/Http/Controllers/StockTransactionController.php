<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockTransactionResource;
use App\Services\StockTransactionService;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    protected $stockTransactionService;

    public function __construct(StockTransactionService $stockTransactionService)
    {
        $this->stockTransactionService = $stockTransactionService;
    }

    public function index()
    {
        $transactions = $this->stockTransactionService->getAllTransactions();
        $purchasesExist = Purchase::exists();
        $customersExist = Customer::exists();

        return view('admin.transaction', compact('transactions', 'purchasesExist', 'customersExist'));
    }

    public function store(Request $request)
    {
        $result = $this->stockTransactionService->createTransaction($request->all());

        if (isset($result['errors'])) {
            return redirect()->back()->withErrors($result['errors'])->withInput();
        }

        return redirect('/admin/transaction')->with('success', 'Stock Transaction Created Successfully');
    }

    public function show($id)
    {
        $transaction = $this->stockTransactionService->getTransactionById($id);
        return new StockTransactionResource($transaction);
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $customers = Customer::all();
        return view('admin.add.transaction', compact('products', 'suppliers', 'customers'));
    }
}
