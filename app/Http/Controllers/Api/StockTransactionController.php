<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockTransactionResource;
use App\Models\StockTransaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with('product')->get();

        if ($transactions->count() > 0) {
            return StockTransactionResource::collection($transactions);
        } else {
            return response()->json([
                'message' => 'No Record Available'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'transaction_type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction = StockTransaction::create($request->all());

        $product = Product::find($request->product_id);

        if ($request->transaction_type === 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return response()->json([
            'message' => 'Stock Transaction Created Successfully',
            'data' => new StockTransactionResource($transaction)
        ], 200);
    }
}
