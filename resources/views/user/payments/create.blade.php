@extends('layouts.app')

@section('title', 'Make Payment')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white border-bottom">
                <h4 class="mb-0"><i class="ti ti-credit-card me-2"></i>Make Payment</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('user.payments.store') }}" id="paymentForm">
                    @csrf
                    <div class="mb-4">
                        <label for="payment_method" class="form-label fw-semibold">
                            <i class="ti ti-wallet me-2"></i>Payment Method <span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-lg @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>
                                Online Payment (Paystack)
                            </option>
                            <option value="reference" {{ old('payment_method') == 'reference' ? 'selected' : '' }}>
                                Payment Reference ID
                            </option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Choose how you want to make your payment</small>
                    </div>

                    <div class="mb-4" id="reference_id_group" style="display: none;">
                        <label for="reference_id" class="form-label fw-semibold">
                            <i class="ti ti-receipt me-2"></i>Reference ID <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="ti ti-key"></i></span>
                            <input type="text" class="form-control @error('reference_id') is-invalid @enderror" 
                                   id="reference_id" name="reference_id" value="{{ old('reference_id') }}" 
                                   placeholder="Enter reference ID">
                        </div>
                        @error('reference_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter the payment reference ID provided by admin</small>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="form-label fw-semibold">
                            <i class="ti ti-currency-naira me-2"></i>Amount (₦) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">₦</span>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                                   id="amount" name="amount" value="{{ old('amount') }}" 
                                   placeholder="0.00" required>
                        </div>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">
                            <i class="ti ti-file-text me-2"></i>Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" 
                                  placeholder="Payment description (optional)">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('user.payments.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="ti ti-x me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="ti ti-arrow-right me-2"></i>Proceed to Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Payment Information</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-shield-check text-success me-2 mt-1 icon-lg"></i>
                            <div>
                                <strong>Secure Payment</strong>
                                <p class="text-muted small mb-0">All transactions are encrypted and secure</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-receipt text-primary me-2 mt-1 icon-lg"></i>
                            <div>
                                <strong>Instant Receipt</strong>
                                <p class="text-muted small mb-0">Receive your receipt immediately after payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('payment_method').addEventListener('change', function() {
    const referenceGroup = document.getElementById('reference_id_group');
    const referenceInput = document.getElementById('reference_id');
    
    if (this.value === 'reference') {
        referenceGroup.style.display = 'block';
        referenceInput.required = true;
    } else {
        referenceGroup.style.display = 'none';
        referenceInput.required = false;
        referenceInput.value = '';
    }
});
</script>
@endpush
@endsection
