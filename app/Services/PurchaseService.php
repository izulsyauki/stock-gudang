<?php

namespace App\Services;

use App\Repository\PurchaseRepository;
use App\Models\Purchase;
use Illuminate\Support\Facades\Validator;
use App\Services\StockTransactionService;

class PurchaseService
{
    protected $purchaseRepository;
    protected $stockTransactionService;

    public function __construct(PurchaseRepository $purchaseRepository, StockTransactionService $stockTransactionService)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->stockTransactionService = $stockTransactionService;
    }

    public function getAllPurchases($options = [])
    {
        $query = Purchase::query();

        if (isset($options['search']) && !empty($options['search'])) {
            $query->whereHas('product', function ($q) use ($options) {
                $q->where('name', 'like', '%' . $options['search'] . '%');
            })->orWhereHas('supplier', function ($q) use ($options) {
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

    public function createPurchase(array $data)
    {
        $validator = Validator::make($data, [
            'supplier_id' => 'required|exists:supplier,id',
            'product_id' => 'required|exists:product,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $purchase = $this->purchaseRepository->create($data);

        $transactionData = [
            'product_id' => $data['product_id'],
            'transaction_type' => 'in',
            'quantity' => $data['quantity'],
            'supplier_id' => $data['supplier_id'],
        ];
        $this->stockTransactionService->createTransaction($transactionData);

        return $purchase;
    }

    public function deletePurchase($id)
    {
        $purchase = $this->purchaseRepository->findById($id);
        return $this->purchaseRepository->delete($purchase);
    }
}