@extends('layouts.app')

@section('title', 'All Payments')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-1"><i class="ti ti-credit-card me-2 text-primary"></i>All Payments</h2>
        <p class="text-muted mb-0">Complete transaction history across all users</p>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>User</th>
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
                        <td><code class="bg-light px-2 py-1 rounded small">{{ Str::limit($payment->payment_reference, 14) }}</code></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-size: 0.8rem; font-weight: 700; flex-shrink: 0;">
                                    {{ strtoupper(substr($payment->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ Str::limit($payment->user->name, 20) }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ Str::limit($payment->user->email, 24) }}</div>
                                </div>
                            </div>
                        </td>
                        <td><strong class="text-success">₦{{ number_format($payment->amount, 2) }}</strong></td>
                        <td><span class="text-muted small">{{ ucfirst($payment->payment_method) }}</span></td>
                        <td>
                            <span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning') }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td><small class="text-muted fw-semibold">{{ $payment->created_at->format('M d, Y') }}</small></td>
                        <td>
                            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="ti ti-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="ti ti-credit-card text-muted icon-2xl"></i>
                            </div>
                            <p class="text-muted mb-0 fw-semibold">No payments yet</p>
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
