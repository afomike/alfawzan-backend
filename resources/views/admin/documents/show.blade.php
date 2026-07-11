@extends('layouts.app')

@section('title', 'Document Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Document Details</h4>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Title:</dt>
            <dd class="col-sm-9">{{ $document->title }}</dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9">{{ $document->description ?? 'N/A' }}</dd>

            <dt class="col-sm-3">File Name:</dt>
            <dd class="col-sm-9">{{ $document->file_name }}</dd>

            <dt class="col-sm-3">File Size:</dt>
            <dd class="col-sm-9">{{ number_format($document->file_size / 1024, 2) }} KB</dd>

            <dt class="col-sm-3">Status:</dt>
            <dd class="col-sm-9"><span class="badge bg-{{ $document->is_active ? 'success' : 'danger' }}">{{ $document->is_active ? 'Active' : 'Inactive' }}</span></dd>

            <dt class="col-sm-3">Uploaded By:</dt>
            <dd class="col-sm-9">{{ $document->uploader->name }}</dd>

            <dt class="col-sm-3">Uploaded At:</dt>
            <dd class="col-sm-9">{{ $document->created_at->format('M d, Y H:i') }}</dd>
        </dl>

        <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="btn btn-primary">View Document</a>
        <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection

