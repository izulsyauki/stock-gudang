<?php

namespace App\Http\Controllers;

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

    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = $this->productService->getAllProductsPaginated(['order' => 'desc', 'search' => $search], 10);

        return view('admin.products.index', compact('products', 'search'));
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

    public function create()
    {
        return view('admin.products.create');
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return new ProductResource($product);
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        return view('admin.products.edit', compact('product'));
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
