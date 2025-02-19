<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StockTransactionResource;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockTransactionController extends Controller
{
    public function index()
    {
        $transactions = StockTransaction::with(['product', 'supplier', 'customer'])->latest()->get();
        
        if ($transactions->isEmpty()) {
            return response()->json(['message' => 'No Record Available'], 200);
        }
        
        return StockTransactionResource::collection($transactions);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'transaction_type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'error' => $validator->errors()
            ], 422);
        }

        $transaction = StockTransaction::create($request->all());

        return response()->json([
            'message' => 'Stock Transaction Created Successfully',
            'data' => new StockTransactionResource($transaction)
        ], 201);
    }

    public function show(StockTransaction $stockTransaction)
    {
        return new StockTransactionResource($stockTransaction);
    }

    public function update(Request $request, StockTransaction $stockTransaction)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'sometimes|exists:products,id',
            'transaction_type' => 'sometimes|in:in,out',
            'quantity' => 'sometimes|integer|min:1',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'error' => $validator->errors()
            ], 422);
        }

        $stockTransaction->update($request->all());

        return response()->json([
            'message' => 'Stock Transaction Updated Successfully',
            'data' => new StockTransactionResource($stockTransaction)
        ], 200);
    }

    public function destroy(StockTransaction $stockTransaction)
    {
        $stockTransaction->delete();
        return response()->json([
            'message' => 'Stock Transaction Deleted Successfully'
        ], 200);
    }
}
