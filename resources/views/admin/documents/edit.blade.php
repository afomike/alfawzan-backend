@extends('layouts.app')

@section('title', 'Edit Document')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Document</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.documents.update', $document) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $document->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $document->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">PDF File (Leave empty to keep current file)</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Current file: {{ $document->file_name }}</small>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ old('is_active', $document->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active (Visible to users)</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Document</button>
                    <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

