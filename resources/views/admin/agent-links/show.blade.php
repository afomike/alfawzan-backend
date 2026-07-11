@extends('layouts.app')

@section('title', 'Agent Link Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Agent Link Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Name:</dt>
            <dd class="col-sm-9">{{ $agentLink->name }}</dd>

            <dt class="col-sm-3">Agent:</dt>
            <dd class="col-sm-9">{{ $agentLink->agent ? $agentLink->agent->name : 'N/A' }}</dd>

            <dt class="col-sm-3">Unique Link:</dt>
            <dd class="col-sm-9"><a href="{{ $agentLink->full_url }}" target="_blank">{{ $agentLink->full_url }}</a></dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-{{ $agentLink->is_active ? 'success' : 'danger' }}">{{ $agentLink->is_active ? 'Active' : 'Inactive' }}</span></dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9">{{ $agentLink->description ?? 'N/A' }}</dd>

            <dt class="col-sm-3">Created By:</dt>
            <dd class="col-sm-9">{{ $agentLink->creator->name }}</dd>

            <dt class="col-sm-3">Total Payments:</dt>
            <dd class="col-sm-9">{{ $agentLink->payments->count() }}</dd>
        </dl>

        <h5 class="mt-4">Payments</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agentLink->payments as $payment)
                <tr>
                    <td>{{ $payment->payment_reference }}</td>
                    <td>{{ $payment->user->name }}</td>
                    <td>₦{{ number_format($payment->amount, 2) }}</td>
                    <td><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : 'warning' }}">{{ ucfirst($payment->status) }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.agent-links.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection

