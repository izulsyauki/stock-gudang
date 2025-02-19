<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'product'])->get();

        if ($purchases->count() > 0) {
            return PurchaseResource::collection($purchases);
        } else {
            return response()->json([
                'message' => 'No Record Available'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $purchase = Purchase::create($request->all());

        $product = Product::find($request->product_id);
        $product->increment('stock', $request->quantity);

        return response()->json([
            'message' => 'Purchase Created Successfully',
            'data' => new PurchaseResource($purchase)
        ], 200);
    }
}
