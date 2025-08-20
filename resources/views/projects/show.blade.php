@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Task Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Title:</div>
                <div class="col-md-8">{{ $task->title }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Description:</div>
                <div class="col-md-8">{{ $task->description ?? '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Assigned To:</div>
                <div class="col-md-8">{{ $task->employee->name ?? '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Status:</div>
                <div class="col-md-8">
                    @if($task->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($task->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($task->status === 'under_review')
                        <span class="badge bg-primary">Under Review</span>
                    @elseif($task->status === 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                    @endif
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Due Date:</div>
                <div class="col-md-8">{{ $task->due_date ?? '-' }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4 fw-bold">Remarks:</div>
                <div class="col-md-8">{{ $task->remarks ?? '-' }}</div>
            </div>
        </div>
        <div class="card-footer text-end bg-light">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to Projects
            </a>
        </div>
    </div>
</div>
@endsection
