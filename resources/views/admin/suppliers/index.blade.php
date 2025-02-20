@extends('layouts.admin')

@section('title', 'Supplier Management')
@section('page_title', 'Supplier Management')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-4">
        <div class="container-fluid">
            <h4>Supplier Management</h4>
        </div>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary">Add New Supplier</a>
            <div class="d-flex">
                <form action="{{ route('supplier.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search suppliers" value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-outline-dark">Search</button>
                </form>
                <a href="{{ route('supplier.index') }}" class="btn btn-dark ms-2">Show All</a>
            </div>
        </div>
        @if ($suppliers->isEmpty())
            <div class="w-50 mx-auto">
                <img src="{{ asset('images/no-data-image.png') }}" class="img-fluid" alt="No data found">
                <h4 class="text-center ">No data found</h4>
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier Name</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>
                                <a href="{{ route('supplier.edit', $supplier->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this supplier?');">
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
    </div>
@endsection
