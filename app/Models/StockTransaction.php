<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $table = 'stock_transaction';

    protected $fillable = [
        'product_id',
        'transaction_type',
        'quantity',
        'supplier_id',
        'customer_id',
    ];

    /**
     * Relasi ke tabel Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke tabel Supplier (hanya untuk transaksi masuk)
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relasi ke tabel Customer (hanya untuk transaksi keluar)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
