<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'product'])->get();

        // if ($purchases->count() > 0) {
        //     return PurchaseResource::collection($purchases);
        // } else {
        //     return response()->json([
        //         'message' => 'No Record Available'
        //     ], 200);
        // }

        if ($purchases->count() > 0) {
            return view('admin.purchases', ['purchases' => $purchases]);
        } else {
            return view('admin.purchases', ['purchases' => []]);
        }
    }

    public function create()
    {
        $products = Product::get();
        $suppliers = Supplier::get();
        return view('admin.add.purchases', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:supplier,id',
            'product_id' => 'required|exists:product,id',
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

        // return response()->json([
        //     'message' => 'Purchase Created Successfully',
        //     'data' => new PurchaseResource($purchase)
        // ], 200);

        return redirect('/admin/purchases')->with('success', 'Purchase Created Successfully');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        

        // return response()->json([
        //     'message' => 'Purchase Deleted Successfully'
        // ], 200);

        return redirect('/admin/purchases')->with('success', 'Purchase Deleted Successfully');
    }
}
