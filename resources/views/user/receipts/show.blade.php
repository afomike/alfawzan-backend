@extends('layouts.app')

@section('title', 'Receipt Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Receipt Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Receipt Number:</dt>
            <dd class="col-sm-9"><code>{{ $receipt->receipt_number }}</code></dd>

            <dt class="col-sm-3">Payment Reference:</dt>
            <dd class="col-sm-9">{{ $receipt->payment->payment_reference }}</dd>

            <dt class="col-sm-3">Amount:</dt>
            <dd class="col-sm-9">₦{{ number_format($receipt->payment->amount, 2) }}</dd>

            <dt class="col-sm-3">Payment Method:</dt>
            <dd class="col-sm-9">{{ ucfirst($receipt->payment->payment_method) }}</dd>

            <dt class="col-sm-3">Generated At:</dt>
            <dd class="col-sm-9">{{ $receipt->generated_at->format('M d, Y H:i') }}</dd>

            @if($receipt->signature_path)
            <dt class="col-sm-3">Digital Signature:</dt>
            <dd class="col-sm-9">
                <img src="{{ Storage::url($receipt->signature_path) }}" alt="Digital Signature" style="max-width: 200px;">
            </dd>
            @endif
        </dl>

        <div class="mt-4">
            <a href="{{ route('user.receipts.download', $receipt) }}" class="btn btn-primary">Download PDF</a>
            <a href="{{ route('user.receipts.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection

