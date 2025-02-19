<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Services\PurchaseService;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        $purchases = $this->purchaseService->getAllPurchases();
        $productsExist = Product::exists();
        $suppliersExist = Supplier::exists();

        return view('admin.purchases', compact('purchases', 'productsExist', 'suppliersExist'));
    }

    public function create()
    {
        $products = Product::get();
        $suppliers = Supplier::get();
        return view('admin.add.purchases', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $result = $this->purchaseService->createPurchase($request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $result['errors']
            ], 422);
        }

        return redirect('/admin/purchases')->with('success', 'Purchase Created Successfully');
    }

    public function destroy($id)
    {
        $this->purchaseService->deletePurchase($id);
        return redirect('/admin/purchases')->with('success', 'Purchase Deleted Successfully');
    }
}
