@extends('layouts.auth')

@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 shadow-lg rounded-4 overflow-hidden">
            <!-- Bagian Kiri (Logo + Ilustrasi) -->
            <div
                class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center bg-primary text-white">
                <h2 class="fw-bold">Welcome Back!</h2>
                <p class="text-center">Login to continue and explore amazing features.</p>
            </div>

            <!-- Bagian Kanan (Form Login) -->
            <div class="col-md-6 d-flex align-items-center justify-content-center p-4">
                <div class="w-100" style="max-width: 400px;">
                    <h3 class="text-center fw-bold mb-3">Login</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <p class="text-center mt-3">
                            Don't have an account? <a href="{{ route('register') }}">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
