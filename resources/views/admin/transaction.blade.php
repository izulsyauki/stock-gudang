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
        <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3">Add New Transaction</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Transaction Type</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Customer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ $transaction->supplier->name ?? 'N/A' }}</td>
                        <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
