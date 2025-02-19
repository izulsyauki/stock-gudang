<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        if ($customers->count() > 0) {
            $customers = CustomerResource::collection($customers);
        }
        // else {
        //     return response()->json([
        //         'message' => 'No Record Available'
        //     ], 200);
        // }

        return view('admin.customers', compact('customers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        Customer::create($request->all());

        return redirect('/admin/customers')->with('success', 'Customer Created Successfully');
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function create()
    {
        return view('admin.add.customers');
    }

    public function edit(Customer $customer)
    {
        return view('admin.edit.customers',  compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customer,email,' . $customer->id,
            'phone' => 'sometimes|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer->update($request->all());

        return redirect('/admin/customers')->with('success', 'Customer Updated Successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect('/admin/customers')->with('success', 'Customer Deleted Successfully');
    }
}
