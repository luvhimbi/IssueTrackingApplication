@extends('Layouts.app')
@section('title', 'Edit Issue')

@section('content')
    <h2>Edit Issue</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('issues.update', $issue) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $issue->title) }}">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $issue->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                @foreach(['open','in_progress','resolved','closed'] as $status)
                    <option value="{{ $status }}" {{ $issue->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-select">
                @foreach(['low','medium','high','critical'] as $priority)
                    <option value="{{ $priority }}" {{ $issue->priority == $priority ? 'selected' : '' }}>{{ ucfirst($priority) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
