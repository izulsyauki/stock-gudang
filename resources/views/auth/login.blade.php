@extends('layouts.auth')

@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 shadow-lg rounded-4 overflow-hidden">
            <div class="col-md-6 d-none d-md-flex flex-column align-items-center justify-content-center bg-primary text-white">
                <h2 class="fw-bold">Welcome Back!</h2>
                <p class="text-center">Login to continue and explore amazing features.</p>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center p-4">
                <div class="w-100" style="max-width: 400px;">
                    <h3 class="text-center fw-bold mb-3">Login</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                            @if ($errors->has('email'))
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer">
                                    <i class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                            @if ($errors->has('password'))
                                <div class="text-danger">{{ $errors->first('password') }}</div>
                            @endif
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