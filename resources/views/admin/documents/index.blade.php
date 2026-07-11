@extends('layouts.app')

@section('title', 'Documents')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-1"><i class="ti ti-file-type-pdf me-2 text-primary"></i>Documents</h2>
        <p class="text-muted mb-0">Manage PDF files available to students</p>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="{{ route('admin.documents.create') }}" class="btn btn-primary">
            <i class="ti ti-upload me-2"></i>Upload Document
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>File Name</th>
                        <th>Size</th>
                        <th>Status</th>
                        <th>Uploaded By</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-danger bg-opacity-10 rounded-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; flex-shrink: 0;">
                                    <i class="ti ti-file-type-pdf text-danger"></i>
                                </div>
                                <span class="fw-semibold">{{ $document->title }}</span>
                            </div>
                        </td>
                        <td><small class="text-muted">{{ $document->file_name }}</small></td>
                        <td><small class="text-muted">{{ number_format($document->file_size / 1024, 2) }} KB</small></td>
                        <td>
                            <span class="badge bg-{{ $document->is_active ? 'success' : 'danger' }}">
                                {{ $document->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td><small class="fw-semibold">{{ $document->uploader->name }}</small></td>
                        <td><small class="text-muted fw-semibold">{{ $document->created_at->format('M d, Y') }}</small></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.documents.show', $document) }}" class="btn btn-outline-primary" title="View">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <a href="{{ route('admin.documents.edit', $document) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="ti ti-pencil"></i>
                                </a>
                                <form action="{{ route('admin.documents.destroy', $document) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete"
                                            onclick="return confirm('Delete this document?')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="ti ti-file-type-pdf text-muted icon-2xl"></i>
                            </div>
                            <h5 class="text-muted fw-bold mb-2">No documents yet</h5>
                            <p class="text-muted mb-4">Upload your first document to make it available to students.</p>
                            <a href="{{ route('admin.documents.create') }}" class="btn btn-primary">
                                <i class="ti ti-upload me-2"></i>Upload Document
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($documents->hasPages())
    <div class="card-footer bg-white">
        {{ $documents->links() }}
    </div>
    @endif
</div>
@endsection
