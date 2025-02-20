@extends('layouts.admin')

@section('title', 'Product Management')
@section('page_title', 'Product Management')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-4">
        <div class="container-fluid">
            <h4>Product Management</h4>
        </div>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
            <div class="d-flex">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search products"
                        value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-outline-dark ">Search</button>
                </form>
                <a href="{{ route('products.index') }}" class="btn btn-dark ms-2">Show All</a>
            </div>
        </div>
        @if ($products->isEmpty())
            <div class="w-25 mx-auto">
                <img src="{{ asset('images/no-data-image.png') }}" class="img-fluid" alt="No data found">
                <div class="text-center">
                    <h4>No data found</h4>
                    <p>Sorry we can't find any data</p>
                </div>
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td style="max-width: 200px; overflow-x: auto;">{{ $product->description }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>Rp. {{ $product->price }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
