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
        <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary mb-3">Add New Supplier</a>
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
                <tr>
                    <td>1</td>
                    <td>PT. Sukses Jaya</td>
                    <td>+62 8123456789</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
