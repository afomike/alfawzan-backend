@extends('layouts.app')

@section('title', 'Agent Links')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-1"><i class="ti ti-link me-2 text-primary"></i>Agent Links</h2>
        <p class="text-muted mb-0">Manage unique payment links assigned to agents</p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="{{ route('admin.agent-links.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Create New Link
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Agent</th>
                        <th>Unique Link</th>
                        <th>Status</th>
                        <th>Payments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agentLinks as $link)
                    <tr>
                        <td><span class="fw-semibold">{{ $link->name }}</span></td>
                        <td>
                            @if($link->agent)
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.75rem; font-weight: 700; flex-shrink: 0;">
                                        {{ strtoupper(substr($link->agent->name, 0, 1)) }}
                                    </div>
                                    <span class="small fw-semibold">{{ $link->agent->name }}</span>
                                </div>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ $link->full_url }}" target="_blank" class="text-primary text-decoration-none small">
                                <i class="ti ti-external-link me-1"></i>{{ Str::limit($link->full_url, 40) }}
                            </a>
                        </td>
                        <td>
                            <span class="badge bg-{{ $link->is_active ? 'success' : 'danger' }}">
                                {{ $link->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold">{{ $link->payments->count() }}</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.agent-links.show', $link) }}" class="btn btn-outline-primary" title="View">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <a href="{{ route('admin.agent-links.edit', $link) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="ti ti-pencil"></i>
                                </a>
                                <form action="{{ route('admin.agent-links.destroy', $link) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete"
                                            onclick="return confirm('Delete this agent link?')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="ti ti-link text-muted icon-2xl"></i>
                            </div>
                            <h5 class="text-muted fw-bold mb-2">No agent links yet</h5>
                            <p class="text-muted mb-4">Create a link to assign payment tracking to an agent.</p>
                            <a href="{{ route('admin.agent-links.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus me-2"></i>Create Link
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($agentLinks->hasPages())
    <div class="card-footer bg-white">
        {{ $agentLinks->links() }}
    </div>
    @endif
</div>
@endsection
