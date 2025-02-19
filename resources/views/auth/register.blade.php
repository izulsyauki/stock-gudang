@extends('layouts.auth')

@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 shadow-lg rounded-4 overflow-hidden">
            <!-- Bagian Kiri (Logo + Ilustrasi) -->
            <div
                class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center bg-primary text-white">
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
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
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

@push('scripts')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endpush
