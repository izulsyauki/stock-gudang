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
        <h2 class="mb-4">Purchases</h2>
        <button class="btn btn-primary mb-3">Add New Purchase</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Purchase ID</th>
                    <th>Supplier</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PUR-001</td>
                    <td>PT. Sukses Jaya</td>
                    <td>$500</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
