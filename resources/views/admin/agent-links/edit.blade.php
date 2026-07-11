@extends('layouts.app')

@section('title', 'Edit Agent Link')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Edit Agent Link</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.agent-links.update', $agentLink) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Link Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $agentLink->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="agent_id" class="form-label">Agent (Optional)</label>
                        <select class="form-select" id="agent_id" name="agent_id">
                            <option value="">Select Agent (Optional)</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ old('agent_id', $agentLink->agent_id) == $agent->id ? 'selected' : '' }}>{{ $agent->name }} ({{ $agent->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $agentLink->description) }}</textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ old('is_active', $agentLink->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Unique Link:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $agentLink->full_url }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('{{ $agentLink->full_url }}')">Copy</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Link</button>
                    <a href="{{ route('admin.agent-links.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Link copied to clipboard!');
    });
}
</script>
@endpush
@endsection

