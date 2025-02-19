<?php

namespace App\Repository;

use App\Models\Purchase;

class PurchaseRepository
{
    public function getAll()
    {
        return Purchase::all();
    }

    public function create(array $data)
    {
        return Purchase::create($data);
    }

    public function findById($id)
    {
        return Purchase::findOrFail($id);
    }

    public function update(Purchase $purchase, array $data)
    {
        return $purchase->update($data);
    }

    public function delete(Purchase $purchase)
    {
        return $purchase->delete();
    }
}