@extends('layouts.app')

@section('title', 'Login - Alfawzan Driving School')

@section('content')
<div class="row justify-content-center align-items-center min-vh-50">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-car text-white icon-2xl"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Welcome Back</h2>
                    <p class="text-muted">Sign in to your account to continue</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            <i class="ti ti-mail me-2 text-primary"></i>Email Address
                        </label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="Enter your email" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="ti ti-lock me-2 text-primary"></i>Password
                        </label>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Enter your password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label fw-semibold" for="remember">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-primary text-decoration-none fw-semibold">Forgot Password?</a>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="ti ti-login me-2"></i>Sign In
                        </button>
                    </div>
                </form>
                
                <div class="text-center mt-4">
                    <p class="text-muted mb-0">Don't have an account? 
                        <a href="{{ route('driving-school.register') }}" class="text-primary text-decoration-none fw-semibold">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
