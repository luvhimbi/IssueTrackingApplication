@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Your Issues</h3>
        <a href="{{ route('issues.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Create Issue
        </a>
    </div>

    {{-- Kanban Board --}}
    <div class="row" id="kanban-board">
        @php
            $statuses = ['open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed'];
            $priorityColors = ['low' => 'border-success', 'medium' => 'border-warning', 'high' => 'border-danger', 'critical' => 'border-danger'];
            $statusColors = ['open' => 'bg-primary', 'in_progress' => 'bg-info', 'resolved' => 'bg-success', 'closed' => 'bg-secondary'];
        @endphp

        @foreach($statuses as $key => $label)
            <div class="col-md-3 mb-4">
                <div class="card shadow">
                    <div class="card-header text-white text-center fw-bold {{ $statusColors[$key] }}">
                        {{ $label }}
                    </div>
                    <div class="card-body issue-column"
                         data-status="{{ $key }}"
                         style="min-height: 350px; background-color: #f8f9fa;">
                        @foreach($issues->where('status', $key) as $issue)
                            <div class="card mb-3 draggable-issue shadow-sm {{ $priorityColors[$issue->priority] ?? 'border-secondary' }}"
                                 data-id="{{ $issue->id }}"
                                 draggable="true"
                                 style="border-width: 2px; cursor: grab;">
                                <div class="card-body p-2 d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>{{ $issue->title }}</strong>
                                        <p class="mb-1">
                                            <span class="badge {{ $statusColors[$issue->status] }} text-white">{{ ucfirst(str_replace('_',' ',$issue->status)) }}</span>
                                            <span class="badge bg-light text-dark">{{ ucfirst($issue->priority) }}</span>
                                        </p>
                                    </div>
                                    <div class="ms-2 d-flex align-items-center">
                                        <a href="{{ route('issues.edit', $issue) }}" class="text-warning me-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-link p-0 text-danger delete-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-id="{{ $issue->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Issue</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this issue? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- SortableJS --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Drag and Drop
            document.querySelectorAll('.issue-column').forEach(function (column) {
                new Sortable(column, {
                    group: 'issues',
                    animation: 150,
                    onAdd: function (evt) {
                        let issueId = evt.item.dataset.id;
                        let newStatus = evt.to.dataset.status;

                        fetch(`/issues/${issueId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: newStatus })
                        }).then(response => {
                            if (!response.ok) {
                                alert('Error updating status!');
                            }
                        }).catch(() => alert('Server error updating status.'));
                    }
                });
            });

            // Delete button click - set form action
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteForm = document.getElementById('deleteForm');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const issueId = this.dataset.id;
                    deleteForm.action = `/issues/${issueId}`;
                });
            });

        });
    </script>

@endsection
