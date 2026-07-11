@extends('layouts.app')

@section('title', 'Documents')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-5">
    <div>
        <h2 class="mb-1"><i class="ti ti-file-type-pdf me-2 text-primary"></i>Documents</h2>
        <p class="text-muted mb-0">Download your certificates and training materials</p>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Uploaded</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-danger bg-opacity-10 rounded-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                    <i class="ti ti-file-type-pdf text-danger"></i>
                                </div>
                                <span class="fw-semibold">{{ $document->title }}</span>
                            </div>
                        </td>
                        <td><span class="text-muted">{{ $document->description ? Str::limit($document->description, 60) : '—' }}</span></td>
                        <td><small class="text-muted">{{ number_format($document->file_size / 1024, 2) }} KB</small></td>
                        <td><small class="text-muted fw-semibold">{{ $document->created_at->format('M d, Y') }}</small></td>
                        <td>
                            <a href="{{ route('user.documents.download', $document) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-download me-1"></i>Download
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="ti ti-file-type-pdf text-muted icon-2xl"></i>
                            </div>
                            <h5 class="text-muted fw-bold mb-1">No documents available</h5>
                            <p class="text-muted mb-0">Documents uploaded by your school will appear here.</p>
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
