<?php

namespace App\Services;

use App\Models\Supplier;
use App\Repository\SupplierRepository;
use Illuminate\Support\Facades\Validator;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers($options = [])
    {
        $query = Supplier::query();

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

    public function getAllSuppliersPaginated($options = [], $perPage = 10)
    {
        $query = Supplier::query();

        if (isset($options['search']) && !empty($options['search'])) {
            $query->where('name', 'like', '%' . $options['search'] . '%');
        }

        if (isset($options['order']) && $options['order'] === 'desc') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        return $query->paginate($perPage);
    }

    public function createSupplier(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'address' => 'nullable',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        return $this->supplierRepository->create($data);
    }

    public function getSupplierById($id)
    {
        return $this->supplierRepository->findById($id);
    }

    public function updateSupplier($id, array $data)
    {
        $supplier = $this->supplierRepository->findById($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'address' => 'nullable',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        return $this->supplierRepository->update($supplier, $data);
    }

    public function deleteSupplier($id)
    {
        $supplier = $this->supplierRepository->findById($id);
        return $this->supplierRepository->delete($supplier);
    }
}