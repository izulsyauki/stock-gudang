<?php

namespace App\Repository;

use App\Models\Customer;

class CustomerRepository
{
    public function getAll()
    {
        return Customer::all();
    }

    public function create(array $data)
    {
        return Customer::create($data);
    }

    public function findById($id)
    {
        return Customer::findOrFail($id);
    }

    public function update(Customer $customer, array $data)
    {
        return $customer->update($data);
    }

    public function delete(Customer $customer)
    {
        return $customer->delete();
    }
}