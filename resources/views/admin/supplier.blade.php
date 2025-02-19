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
        <a href="{{ route('admin.add.supplier') }}" class="btn btn-primary mb-3">Add New Supplier</a>
        @if ($suppliers->isEmpty())
            <div class="w-50 mx-auto">
                <img src="{{ asset('images/no-data-image.png') }}" class="img-fluid" alt="No data found">
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
