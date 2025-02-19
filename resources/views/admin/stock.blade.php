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
        <button class="btn btn-primary mb-3">Add Stock Transaction</button>
        <table class="table table-bordered rounded-xl">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Product A</td>
                    <td>50</td>
                    <td><span class="badge bg-success">In</span></td>
                    <td>2025-02-18</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
