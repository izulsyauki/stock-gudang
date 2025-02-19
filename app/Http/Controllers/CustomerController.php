<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->getAllCustomers();

        if ($customers->count() > 0) {
            $customers = CustomerResource::collection($customers);
        }

        return view('admin.customers', compact('customers'));
    }

    public function store(Request $request)
    {
        $result = $this->customerService->createCustomer($request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $result['errors']
            ], 422);
        }

        return redirect('/admin/customers')->with('success', 'Customer Created Successfully');
    }

    public function show($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        return new CustomerResource($customer);
    }

    public function create()
    {
        return view('admin.add.customers');
    }

    public function edit($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        return view('admin.edit.customers', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->customerService->updateCustomer($id, $request->all());

        if (isset($result['errors'])) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $result['errors']
            ], 422);
        }

        return redirect('/admin/customers')->with('success', 'Customer Updated Successfully');
    }

    public function destroy($id)
    {
        $this->customerService->deleteCustomer($id);
        return redirect('/admin/customers')->with('success', 'Customer Deleted Successfully');
    }
}
