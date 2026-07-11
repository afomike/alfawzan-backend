@extends('layouts.app')

@section('title', 'Payment Reference Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Payment Reference Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Reference ID:</dt>
            <dd class="col-sm-9"><code>{{ $paymentReference->reference_id }}</code></dd>

            <dt class="col-sm-3">User:</dt>
            <dd class="col-sm-9">{{ $paymentReference->user ? $paymentReference->user->name : 'N/A' }}</dd>

            <dt class="col-sm-3">Amount:</dt>
            <dd class="col-sm-9">₦{{ number_format($paymentReference->amount, 2) }}</dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-{{ $paymentReference->status === 'used' ? 'success' : ($paymentReference->status === 'expired' ? 'danger' : 'warning') }}">{{ ucfirst($paymentReference->status) }}</span></dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9">{{ $paymentReference->description ?? 'N/A' }}</dd>

            <dt class="col-sm-3">Expires At:</dt>
            <dd class="col-sm-9">{{ $paymentReference->expires_at ? $paymentReference->expires_at->format('M d, Y H:i') : 'Never' }}</dd>

            <dt class="col-sm-3">Created By:</dt>
            <dd class="col-sm-9">{{ $paymentReference->creator->name }}</dd>

            @if($paymentReference->payment)
            <dt class="col-sm-3">Payment:</dt>
            <dd class="col-sm-9">
                <a href="{{ route('admin.payments.show', $paymentReference->payment) }}">{{ $paymentReference->payment->payment_reference }}</a>
            </dd>
            @endif
        </dl>

        <a href="{{ route('admin.payment-references.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection

