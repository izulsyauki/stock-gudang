<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockTransactionResource;
use App\Models\Customer;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'supplier', 'customer'])->latest()->get();

        // if ($transactions->isEmpty()) {
        //     return response()->json(['message' => 'No Record Available'], 200);
        // }

        return view('admin.transaction', compact('transactions'));
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

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'error' => $validator->errors()
            ], 422);
        }

        StockTransaction::create($request->all());

        if ($request->transaction_type == 'in') {
            $product = Product::find($request->product_id);
            $product->increment('stock', $request->quantity);
        } else {
            $product = Product::find($request->product_id);
            $product->decrement('stock', $request->quantity);
        }

        // return response()->json([
        //     'message' => 'Stock Transaction Created Successfully',
        //     'data' => new StockTransactionResource($transaction)
        // ], 201);

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
