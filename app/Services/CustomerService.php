<?php

namespace App\Services;

use App\Repository\CustomerRepository;
use Illuminate\Support\Facades\Validator;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    public function createCustomer(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        return $this->customerRepository->create($data);
    }

    public function getCustomerById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function updateCustomer($id, array $data)
    {
        $customer = $this->customerRepository->findById($id);

        $validator = Validator::make($data, [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customer,email,' . $customer->id,
            'phone' => 'sometimes|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        return $this->customerRepository->update($customer, $data);
    }

    public function deleteCustomer($id)
    {
        $customer = $this->customerRepository->findById($id);
        return $this->customerRepository->delete($customer);
    }
}