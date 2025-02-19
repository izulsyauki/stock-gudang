<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        if ($products->count() > 0) {
            $products = ProductResource::collection($products);
        }

        return view('admin.products', compact('products'));
    }

    public function store(Request $request)
    {
        $result = $this->productService->createProduct($request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $result['errors']
            ], 422);
        }

        return redirect('/admin/products')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return new ProductResource($product);
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        return view('admin.edit.products', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->productService->updateProduct($id, $request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $result['errors']
            ], 422);
        }

        return redirect('/admin/products')->with('success', 'Product Updated Successfully');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect('/admin/products')->with('success', 'Product Deleted Successfully');
    }
}
