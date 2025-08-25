@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Issues Index Section --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Your Issues</h3>
        <a href="{{ route('issues.create') }}" class="btn btn-primary">Create Issue</a>
    </div>

    @if(isset($issues) && $issues->count() > 0)
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($issue->status) }}</span></td>
                    <td><span class="badge bg-info">{{ ucfirst($issue->priority) }}</span></td>
                    <td>{{ $issue->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('issues.show', $issue) }}" class="btn btn-sm btn-success">View</a>
                        <a href="{{ route('issues.edit', $issue) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('issues.destroy', $issue) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this issue?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No issues found. <a href="{{ route('issues.create') }}">Create your first issue</a>.</p>
    @endif
@endsection

