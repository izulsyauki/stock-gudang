<?php

namespace App\Services;

use App\Repository\PurchaseRepository;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class PurchaseService
{
    protected $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function getAllPurchases()
    {
        return $this->purchaseRepository->getAll();
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

        $product = Product::find($data['product_id']);
        $product->increment('stock', $data['quantity']);

        return $purchase;
    }

    public function deletePurchase($id)
    {
        $purchase = $this->purchaseRepository->findById($id);
        return $this->purchaseRepository->delete($purchase);
    }
}