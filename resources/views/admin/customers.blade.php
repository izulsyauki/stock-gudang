@extends('layouts.admin')

@section('title', 'Customer Orders')
@section('page_title', 'Customer Orders')

@section('content')
    
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Customer Orders</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->user->name }}</td>
                                <td>{{ $customer->product->name }}</td>
                                <td>{{ $customer->quantity }}</td>
                                <td>${{ number_format($customer->total_price, 2) }}</td>
                                <td><span
                                        class="badge bg-{{ $customer->status == 'completed' ? 'success' : ($customer->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($customer->status) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
