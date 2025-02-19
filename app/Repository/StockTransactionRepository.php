<?php

namespace App\Repository;

use App\Models\StockTransaction;

class StockTransactionRepository
{
    public function getAll()
    {
        return StockTransaction::all();
    }

    public function create(array $data)
    {
        return StockTransaction::create($data);
    }

    public function findById($id)
    {
        return StockTransaction::findOrFail($id);
    }
}
