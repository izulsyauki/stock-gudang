@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Add Purchase</h2>
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select class="form-control @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id"
                    required>
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

            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-control @error('product_id') is-invalid @enderror" id="product_id" name="product_id"
                    required>
                    <option value="" selected disabled>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}"
                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Rp {{ number_format($product->price, 2) }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
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

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="text" class="form-control @error('total_price') is-invalid @enderror" id="total_price"
                    name="total_price" required readonly value="{{ old('total_price') }}">
                @error('total_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Add Purchase</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotalPrice() {
                const selectedProduct = productSelect.options[productSelect.selectedIndex];
                const price = selectedProduct.getAttribute('data-price') || 0;
                const quantity = quantityInput.value || 1;
                const total = price * quantity;
                totalPriceInput.value = total.toFixed(2);
            }

            productSelect.addEventListener('change', calculateTotalPrice);
            quantityInput.addEventListener('input', calculateTotalPrice);
        });
    </script>
@endsection
