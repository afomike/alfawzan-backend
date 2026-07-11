@extends('layouts.app')

@section('title', 'My Payments')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-1"><i class="ti ti-credit-card me-2 text-primary"></i>My Payments</h2>
        <p class="text-muted mb-0">Track all your payment transactions</p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="{{ route('user.payments.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Make New Payment
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td><code class="bg-light px-2 py-1 rounded small">{{ $payment->payment_reference }}</code></td>
                        <td><strong class="text-success">₦{{ number_format($payment->amount, 2) }}</strong></td>
                        <td><span class="text-muted">{{ ucfirst($payment->payment_method) }}</span></td>
                        <td>
                            <span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td><small class="text-muted fw-semibold">{{ $payment->created_at->format('M d, Y') }}</small></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('user.payments.show', $payment) }}" class="btn btn-outline-primary" title="View">
                                    <i class="ti ti-eye"></i>
                                </a>
                                @if($payment->receipt)
                                <a href="{{ route('user.receipts.show', $payment->receipt) }}" class="btn btn-outline-success" title="Receipt">
                                    <i class="ti ti-receipt"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="ti ti-credit-card text-muted icon-2xl"></i>
                            </div>
                            <h5 class="text-muted mb-2 fw-bold">No payments yet</h5>
                            <p class="text-muted mb-4">Make your first payment to get started.</p>
                            <a href="{{ route('user.payments.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus me-2"></i>Make Payment
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($payments->hasPages())
    <div class="card-footer bg-white">
        {{ $payments->links() }}
    </div>
    @endif
</div>
@endsection
