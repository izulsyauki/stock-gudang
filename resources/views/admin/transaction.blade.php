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
        @if (!$purchasesExist || !$customersExist)
            <div class="alert alert-warning">
                You must add at least one purchase, and one customer before adding a new transaction.
            </div>
        @endif
        <a href="{{ route('transaction.create') }}" class="btn btn-primary mb-3"
            @if (!$purchasesExist || !$customersExist) hidden @endif>Add New Transaction</a>
        @if ($transactions->isEmpty())
            <div class="w-50 mx-auto">
                <img src="{{ asset('images/no-data-image.png') }}" class="img-fluid" alt="No data found">
                <h4 class="text-center ">No data found</h4>
            </div>
        @else
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
                            <td>
                                @if ($transaction->transaction_type == 'in')
                                    <span class="badge bg-success">In</span>
                                @else
                                    <span class="badge bg-danger">Out</span>
                                @endif
                            </td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ $transaction->supplier->name ?? 'N/A' }}</td>
                            <td>{{ $transaction->customer->name ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
