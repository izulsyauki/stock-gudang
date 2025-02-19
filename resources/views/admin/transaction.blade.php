@extends('layouts.admin')

@section('title', 'Stock Transactions')
@section('page_title', 'Stock Transactions')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-4">
        <div class="container-fluid">
            <h4>Stock Transactions</h4>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('admin.add.transaction') }}" class="btn btn-primary mb-3">Add New Transaction</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Transaction Type</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Customer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Product A</td>
                    <td>In</td>
                    <td>20</td>
                    <td>PT. Sukses Jaya</td>
                    <td>John Doe</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
