@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-clipboard-check"></i> Task Details
        </h2>
        <p class="text-muted">Here are the full details of your assigned task</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    
                    <!-- Title -->
                    <h3 class="fw-bold mb-3 text-dark">
                        {{ $task->title }}
                    </h3>
                    
                    <!-- Status Badge -->
                    <div class="mb-4">
                        @php
                            $statusColors = [
                                'approved' => 'success',
                                'pending' => 'warning',
                                'under_review' => 'primary',
                                'rejected' => 'danger'
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$task->status] ?? 'secondary' }} px-3 py-2 fs-6">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>

                    <!-- Info Grid -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <p class="text-muted mb-1"><i class="bi bi-folder"></i> Project</p>
                                <h6 class="fw-semibold">{{ $task->project->name ?? $task->project->title ?? 'N/A' }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <p class="text-muted mb-1"><i class="bi bi-calendar-event"></i> Due Date</p>
                                <h6 class="fw-semibold">
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'N/A' }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <p class="text-muted mb-1"><i class="bi bi-card-text"></i> Description</p>
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            {!! nl2br(e($task->description ?? '-')) !!}
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="mt-4">
                        <p class="text-muted mb-1"><i class="bi bi-chat-left-text"></i> Remarks</p>
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            {{ $task->remarks ?? '-' }}
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="text-end mt-4">
                        <a href="{{ route('tasks.my') }}" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="bi bi-arrow-left"></i> Back to My Tasks
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
