<?php

namespace App\Services;

use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts($options = [])
    {
        $query = Product::query();

        if (isset($options['search']) && !empty($options['search'])) {
            $query->where('name', 'like', '%' . $options['search'] . '%');
        }

        if (isset($options['order']) && $options['order'] === 'desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        return $query->get();
    }

    public function createProduct(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        return $this->productRepository->create($data);
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->productRepository->findById($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct($id)
    {
        $product = $this->productRepository->findById($id);
        return $this->productRepository->delete($product);
    }
}