<?php

namespace App\Services;

use App\Repository\StockTransactionRepository;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Validator;

class StockTransactionService
{
    protected $stockTransactionRepository;

    public function __construct(StockTransactionRepository $stockTransactionRepository)
    {
        $this->stockTransactionRepository = $stockTransactionRepository;
    }

    public function getAllTransactions($options = [])
    {
        $query = StockTransaction::query();

        if (isset($options['search']) && !empty($options['search'])) {
            $query->whereHas('product', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            })->orWhereHas('supplier', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            })->orWhereHas('customer', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            });
        }

        if (isset($options['order']) && $options['order'] === 'desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        return $query->get();
    }

    public function getAllTransactionsPaginated($options = [], $perPage = 10)
    {
        $query = StockTransaction::query();

        if (isset($options['search']) && !empty($options['search'])) {
            $query->whereHas('product', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            })->orWhereHas('supplier', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            })->orWhereHas('customer', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            });
        }

        if (isset($options['order']) && $options['order'] === 'desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        return $query->paginate($perPage);
    }

    public function createTransaction(array $data)
    {
        $validator = Validator::make($data, [
            'product_id' => 'required|exists:product,id',
            'transaction_type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'nullable|exists:supplier,id',
            'customer_id' => 'nullable|exists:customer,id',
        ]);

        $validator->sometimes('supplier_id', 'required', function ($input) {
            return $input->transaction_type == 'in';
        });

        $validator->sometimes('customer_id', 'required', function ($input) {
            return $input->transaction_type == 'out';
        });

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $product = Product::find($data['product_id']);

        if ($data['transaction_type'] == 'out' && $product->stock < $data['quantity']) {
            return ['errors' => ['quantity' => 'Insufficient stock for this transaction']];
        }

        $transaction = $this->stockTransactionRepository->create($data);

        if ($data['transaction_type'] == 'in') {
            $product->increment('stock', $data['quantity']);
        } else {
            $product->decrement('stock', $data['quantity']);
        }

        return $transaction;
    }

    public function getTransactionById($id)
    {
        return $this->stockTransactionRepository->findById($id);
    }
}
