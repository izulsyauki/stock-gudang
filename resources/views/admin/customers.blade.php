@extends('layouts.admin')

@section('title', 'Customers')
@section('page_title', 'Customers')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-4">
        <div class="container-fluid">
            <h4>Customers</h4>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>
        @if ($customers->isEmpty())
            <div class="w-40 mx-auto">
                <img src="{{ asset('images/no-data-image.png') }}" class="img-fluid" alt="No data found">
                <h4 class="text-center ">No data found</h4>
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
