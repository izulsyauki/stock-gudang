@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3 mb-4">
        <div class="container-fluid">
            <h4>Dashboard</h4>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h5><i class="fas fa-truck text-primary"></i> Total Suppliers</h5>
                    <p class="fw-bold text-primary">120</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h5><i class="fas fa-exchange-alt text-success"></i> Stock Transactions</h5>
                    <p class="fw-bold text-success">350</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h5><i class="fas fa-shopping-cart text-danger"></i> Purchases</h5>
                    <p class="fw-bold text-danger">50</p>
                </div>
            </div>
        </div>
    </div>
@endsection
