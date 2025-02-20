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

    public function index(Request $request)
    {
        $search = $request->input('search');
        $transactions = $this->stockTransactionService->getAllTransactions(['order' => 'desc', 'search' => $search]);
        $purchasesExist = Purchase::exists();
        $customersExist = Customer::exists();

        return view('admin.stock_transactions.index', compact('transactions', 'purchasesExist', 'customersExist', 'search'));
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
        return view('admin.stock_transactions.create', compact('products', 'suppliers', 'customers'));
    }
}
