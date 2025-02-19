<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        if ($suppliers->count() > 0) {
            $suppliers = SupplierResource::collection($suppliers);
        }

        return view('admin.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $result = $this->supplierService->createSupplier($request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $result['errors']
            ], 422);
        }

        return redirect('/admin/supplier')->with('success', 'Supplier Created Successfully');
    }

    public function show($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        return new SupplierResource($supplier);
    }

    public function edit($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        return view('admin.edit.supplier', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->supplierService->updateSupplier($id, $request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $result['errors']
            ], 422);
        }

        return redirect('/admin/supplier')->with('success', 'Supplier Updated Successfully');
    }

    public function destroy($id)
    {
        $this->supplierService->deleteSupplier($id);
        return redirect('/admin/supplier')->with('success', 'Supplier Deleted Successfully');
    }
}
