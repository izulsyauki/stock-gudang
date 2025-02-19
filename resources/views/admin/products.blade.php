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
        <a href="{{ route('admin.add.products') }}" class="btn btn-primary mb-3">Add New Supplier</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Product A</td>
                    <td>100</td>
                    <td>$10</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
