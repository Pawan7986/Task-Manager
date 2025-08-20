@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

    <div class="row g-3">
        <!-- Cards -->
        <div class="col-md-3">
            <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm border-0 hover-shadow text-white" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                    <h5>Total Tasks</h5>
                    <h3>{{ $totalTasks }}</h3>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('tasks.index', ['status' => 'approved']) }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm border-0 hover-shadow text-white" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
                    <h5>Completed Tasks</h5>
                    <h3>{{ $completedTasks }}</h3>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('tasks.index', ['status' => 'pending']) }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm border-0 hover-shadow text-white" style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
                    <h5>Pending Tasks</h5>
                    <h3>{{ $pendingTasks }}</h3>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('tasks.index', ['status' => 'under_review']) }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm border-0 hover-shadow text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                    <h5>Under Review</h5>
                    <h3>{{ $underReviewTasks }}</h3>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Tasks Table -->
    <div class="card mt-4 p-3 shadow-sm">
        <h4 class="mb-3">Tasks List @if(request('status')) ({{ ucfirst(request('status')) }}) @endif</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->project->name ?? $task->project->title ?? 'N/A' }}</td>
                        <td>{{ $task->employee->name ?? 'N/A' }}</td>
                        <td>
                            @if($task->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($task->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($task->status == 'under_review')
                                <span class="badge bg-primary">Under Review</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $task->due_date ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No tasks found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Card Hover Effect -->
<style>
.hover-shadow:hover {
    transform: translateY(-8px) scale(1.03);
    transition: all 0.4s ease;
    box-shadow: 0 15px 25px rgba(0,0,0,0.3);
}
</style>
@endsection
