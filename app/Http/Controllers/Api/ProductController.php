<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::get();
        if ($products->count() > 0) {
            $products = ProductResource::collection($products);
        }
        // else {
        //     return response()->json([
        //         'message' => 'No Record Available'
        //     ], 200);
        // }

        return view('admin.products', compact('products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $validator->errors()
            ], 422);
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // return response()->json([
        //     'message' => 'Product Created Successfully',
        //     'data' => new ProductResource($product)
        // ], 200);

        return redirect('/admin/products');
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function edit(Product $product)
    {
        return view('admin.edit.products', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $validator->errors()
            ], 422);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // return response()->json([
        //     'message' => 'Product Updated Successfully',
        //     'data' => new ProductResource($product)
        // ], 200);

        return redirect('/admin/products')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        // return response()->json([
        //     'message' => 'Product Deleted Successfully'
        // ], 200);

        return redirect('/admin/products');
    }
}
