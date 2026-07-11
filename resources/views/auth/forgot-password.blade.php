@extends('layouts.app')

@section('title', 'Forgot Password - Alfawzan Driving School')

@section('content')
<div class="row justify-content-center align-items-center min-vh-50">
    <div class="col-md-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-5">
                    <div class="bg-gradient-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="ti ti-mail text-white icon-2xl"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Forgot Password?</h2>
                    <p class="text-muted">Enter your email to receive password reset instructions</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-check me-2"></i>{{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
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

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="ti ti-send me-2"></i>Send Reset Link
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted mb-0">Remember your password? 
                        <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
