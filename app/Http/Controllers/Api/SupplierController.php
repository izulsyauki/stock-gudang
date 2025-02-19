<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::get();
        if ($suppliers->count() > 0) {
            $suppliers = SupplierResource::collection($suppliers);
        }
        // else {
        //     return response()->json([
        //         'message' => 'No Record Available'
        //     ], 200);
        // }

        return view('admin.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'address' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $validator->errors()
            ], 422);
        }

        dd($request->all());

        $supplier = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // return response()->json([
        //     'message' => 'Supplier Created Successfully',
        //     'data' => new SupplierResource($supplier)
        // ], 200);

        return redirect('/admin/supplier');
    }

    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);;
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.edit.supplier', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'address' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $validator->errors()
            ], 422);
        }

        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // return response()->json([
        //     'message' => 'Supplier Updated Successfully',
        //     'data' => new SupplierResource($supplier)
        // ], 200);

        return redirect('/admin/supplier')->with('success', 'Supplier Updated Successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        // return response()->json([
        //     'message' => 'Product Deleted Successfully'
        // ], 200);

        return redirect('/admin/supplier')->with('success', 'Supplier Deleted Successfully');
    }
}
