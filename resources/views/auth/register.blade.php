@extends('layouts.auth')

@section('content')
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 shadow-lg rounded-4 overflow-hidden">
        <!-- Bagian Kiri (Logo + Ilustrasi) -->
        <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center bg-primary text-white">
            <h2 class="fw-bold">Join Us!</h2>
            <p class="text-center">Create an account to get started.</p>
        </div>

        <!-- Bagian Kanan (Form Register) -->
        <div class="col-md-6 d-flex align-items-center justify-content-center p-4">
            <div class="w-100" style="max-width: 400px;">
                <h3 class="text-center fw-bold mb-3">Register</h3>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                    <p class="text-center mt-3">
                        Already have an account? <a href="{{ route('login') }}">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
