@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>{{ isset($supplier) ? 'Edit Supplier' : 'Add Supplier' }}</h2>
        <form action="{{ isset($supplier) ? route('supplier.update', $supplier->id) : route('supplier.store') }}" method="POST">
            @csrf
            @if(isset($supplier))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="name" class="form-label">Supplier Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    required value="{{ isset($supplier) ? $supplier->name : old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" required value="{{ isset($supplier) ? $supplier->email : old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    name="phone" required value="{{ isset($supplier) ? $supplier->phone : old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                    required>{{ isset($supplier) ? $supplier->address : old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">{{ isset($supplier) ? 'Update Supplier' : 'Add Supplier' }}</button>
            </div>
        </form>
    </div>
@endsection
