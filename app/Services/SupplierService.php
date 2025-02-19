<?php

namespace App\Services;

use App\Repository\SupplierRepository;
use Illuminate\Support\Facades\Validator;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers()
    {
        return $this->supplierRepository->getAll();
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