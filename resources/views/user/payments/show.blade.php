@extends('layouts.app')

@section('title', 'Payment Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Payment Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Payment Reference:</dt>
            <dd class="col-sm-9"><code>{{ $payment->payment_reference }}</code></dd>

            <dt class="col-sm-3">Amount:</dt>
            <dd class="col-sm-9">₦{{ number_format($payment->amount, 2) }}</dd>

            <dt class="col-sm-3">Payment Method:</dt>
            <dd class="col-sm-9">{{ ucfirst($payment->payment_method) }}</dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning') }}">{{ ucfirst($payment->status) }}</span></dd>

            @if($payment->reference_id)
            <dt class="col-sm-3">Reference ID:</dt>
            <dd class="col-sm-9"><code>{{ $payment->reference_id }}</code></dd>
            @endif

            @if($payment->paystack_reference)
            <dt class="col-sm-3">Paystack Reference:</dt>
            <dd class="col-sm-9">{{ $payment->paystack_reference }}</dd>
            @endif

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9">{{ $payment->description ?? 'N/A' }}</dd>

            <dt class="col-sm-3">Date:</dt>
            <dd class="col-sm-9">{{ $payment->created_at->format('M d, Y H:i') }}</dd>

            @if($payment->receipt)
            <dt class="col-sm-3">Receipt:</dt>
            <dd class="col-sm-9">
                <a href="{{ route('user.receipts.show', $payment->receipt) }}" class="btn btn-primary">View Receipt</a>
                <a href="{{ route('user.receipts.download', $payment->receipt) }}" class="btn btn-success">Download Receipt</a>
            </dd>
            @endif
        </dl>

        <a href="{{ route('user.payments.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection

