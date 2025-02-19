<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockTransactionResource;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::all();
        $purchasesExist = Purchase::exists();
        $customersExist = Customer::exists();

        return view('admin.transaction', compact('transactions',  'purchasesExist', 'customersExist'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:product,id',
            'transaction_type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'nullable|exists:supplier,id',
            'customer_id' => 'nullable|exists:customer,id',
        ]);

        $validator->sometimes('supplier_id', 'required', function ($input) {
            return $input->transaction_type == 'in';
        });

        $validator->sometimes('customer_id', 'required', function ($input) {
            return $input->transaction_type == 'out';
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($request->product_id);

        if ($request->transaction_type == 'out' && $product->stock < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Insufficient stock for this transaction'])->withInput();
        }

        StockTransaction::create($request->all());

        if ($request->transaction_type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return redirect('/admin/transaction')->with('success', 'Stock Transaction Created Successfully');
    }

    public function show(StockTransaction $stockTransaction)
    {
        return new StockTransactionResource($stockTransaction);
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        $customers = Customer::all();
        return view('admin.add.transaction', compact('products', 'suppliers', 'customers'));
    }
}
