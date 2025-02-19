@extends('layouts.admin')

@section('title', 'Purchases')
@section('page_title', 'Purchases')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-4">
        <div class="container-fluid">
            <h4>Purchases</h4>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3">Add New Purchase</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->product->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>Rp. {{ $purchase->total_price }}</td>
                        <td>
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this purchased product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No purchases found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
