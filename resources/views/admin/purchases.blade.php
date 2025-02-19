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
        <a href="{{ route('admin.add.products') }}" class="btn btn-primary mb-3">Add New Purchase</a>
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
                <tr>
                    <td>1</td>
                    <td>PT. Sukses Jaya</td>
                    <td>Product A</td>
                    <td>10</td>
                    <td>$500</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
