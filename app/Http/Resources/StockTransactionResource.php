<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            "transaction_type" => $this->transaction_type,
            "quantity" => $this->quantity,
            "supplier_id" => $this->supplier_id,
            "customer_id" => $this->customer_id,
            "created_at" => $this->created_at,
        ];
    }
}
