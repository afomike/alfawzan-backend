@extends('layouts.app')

@section('title', 'Payment References')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="ti ti-receipt me-2"></i>Payment References</h2>
        <p class="text-muted mb-0">Generate and manage payment reference IDs for users</p>
    </div>
    <a href="{{ route('admin.payment-references.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-2"></i>Generate New Reference
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Reference ID</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Expires At</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($references as $reference)
                    <tr>
                        <td>
                            <code class="bg-light px-2 py-1 rounded">{{ $reference->reference_id }}</code>
                        </td>
                        <td>
                            @if($reference->user)
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                        {{ strtoupper(substr($reference->user->name, 0, 1)) }}
                                    </div>
                                    {{ $reference->user->name }}
                                </div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td><strong>₦{{ number_format($reference->amount, 2) }}</strong></td>
                        <td>
                            <span class="badge bg-{{ $reference->status === 'used' ? 'success' : ($reference->status === 'expired' ? 'danger' : 'warning') }}">
                                {{ ucfirst($reference->status) }}
                            </span>
                        </td>
                        <td>{{ $reference->expires_at ? $reference->expires_at->format('M d, Y') : 'Never' }}</td>
                        <td>{{ $reference->creator->name }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.payment-references.show', $reference) }}" class="btn btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(!$reference->isUsed())
                                <form action="{{ route('admin.payment-references.destroy', $reference) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this reference?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #cbd5e1;"></i>
                            <p class="text-muted mt-3">No payment references found. Generate your first reference to get started!</p>
                            <a href="{{ route('admin.payment-references.create') }}" class="btn btn-primary mt-2">
                                <i class="ti ti-plus me-2"></i>Generate Reference
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($references->hasPages())
    <div class="card-footer bg-white">
        {{ $references->links() }}
    </div>
    @endif
</div>
@endsection
