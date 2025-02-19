@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Add Stock Transaction</h2>
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id"
                    required>
                    <option value="" selected disabled>Select Product</option>
                    {{-- Loop daftar produk --}}
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Transaction Type</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('transaction_type') is-invalid @enderror" type="radio"
                            name="transaction_type" id="transaction_in" value="in"
                            {{ old('transaction_type') == 'in' ? 'checked' : '' }}>
                        <label class="form-check-label" for="transaction_in">Stock In</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('transaction_type') is-invalid @enderror" type="radio"
                            name="transaction_type" id="transaction_out" value="out"
                            {{ old('transaction_type') == 'out' ? 'checked' : '' }}>
                        <label class="form-check-label" for="transaction_out">Stock Out</label>
                    </div>
                </div>
                @error('transaction_type')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                    name="quantity" required min="1" value="{{ old('quantity') }}">
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="supplier_section" style="display: none;">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select class="form-control @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                    <option value="" selected disabled>Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="customer_section" style="display: none;">
                <label for="customer_id" class="form-label">Customer</label>
                <select class="form-control @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                    <option value="" selected disabled>Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->user->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol submit di ujung kanan --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Add Transaction</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const transactionTypeIn = document.getElementById('transaction_in');
            const transactionTypeOut = document.getElementById('transaction_out');
            const supplierSection = document.getElementById('supplier_section');
            const customerSection = document.getElementById('customer_section');

            function toggleFields() {
                if (transactionTypeIn.checked) {
                    supplierSection.style.display = 'block';
                    customerSection.style.display = 'none';
                } else if (transactionTypeOut.checked) {
                    supplierSection.style.display = 'none';
                    customerSection.style.display = 'block';
                }
            }

            transactionTypeIn.addEventListener('change', toggleFields);
            transactionTypeOut.addEventListener('change', toggleFields);

            toggleFields();
        });
    </script>
@endsection
