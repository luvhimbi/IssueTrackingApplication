@extends('Layouts.app')
@section('title', 'View Issue')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h3>{{ $issue->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> <span class="badge bg-secondary">{{ ucfirst($issue->status) }}</span></p>
            <p><strong>Priority:</strong> <span class="badge bg-info">{{ ucfirst($issue->priority) }}</span></p>
            <p><strong>Description:</strong></p>
            <p>{{ $issue->description ?? 'No description provided.' }}</p>
            <a href="{{ route('issues.edit', $issue) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('issues.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
