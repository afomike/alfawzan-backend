@extends('layouts.app')

@section('title', 'Generate Payment Reference')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom">
                <h4 class="mb-0"><i class="ti ti-plus me-2"></i>Generate Payment Reference ID</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.payment-references.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="user_id" class="form-label fw-semibold">
                            <i class="ti ti-user me-2"></i>User (Optional)
                        </label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="">Select User (Optional)</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Leave empty to create a general reference ID</small>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="form-label fw-semibold">
                            <i class="ti ti-currency-naira me-2"></i>Amount <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₦</span>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" required>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">
                            <i class="ti ti-file-text me-2"></i>Description
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3" 
                                  placeholder="Payment description (optional)">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="expires_at" class="form-label fw-semibold">
                            <i class="ti ti-calendar me-2"></i>Expires At (Optional)
                        </label>
                        <input type="datetime-local" class="form-control" id="expires_at" name="expires_at" 
                               value="{{ old('expires_at') }}">
                        <small class="form-text text-muted">Leave empty for no expiration</small>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.payment-references.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-x me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-check me-2"></i>Generate Reference
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
