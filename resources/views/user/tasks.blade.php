@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <a href="{{ route('tasks.my') }}" class="text-decoration-none">
                <div class="card text-center p-3 shadow-sm hover-shadow" style="background:#f78ca0; color:white;">
                    <h6>Total Tasks</h6>
                    <h4>{{ $totalTasks }}</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tasks.my', ['status' => 'approved']) }}" class="text-decoration-none">
                <div class="card text-center p-3 shadow-sm hover-shadow" style="background:#43cea2; color:white;">
                    <h6>Completed</h6>
                    <h4>{{ $completedTasks }}</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tasks.my', ['status' => 'pending']) }}" class="text-decoration-none">
                <div class="card text-center p-3 shadow-sm hover-shadow" style="background:#f7971e; color:white;">
                    <h6>Pending</h6>
                    <h4>{{ $pendingTasks }}</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tasks.my', ['status' => 'under_review']) }}" class="text-decoration-none">
                <div class="card text-center p-3 shadow-sm hover-shadow" style="background:#36d1dc; color:white;">
                    <h6>Under Review</h6>
                    <h4>{{ $underReviewTasks }}</h4>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('tasks.my', ['status' => 'rejected']) }}" class="text-decoration-none">
                <div class="card text-center p-3 shadow-sm hover-shadow" style="background:#ff6b6b; color:white;">
                    <h6>Rejected</h6>
                    <h4>{{ $rejectedTasks }}</h4>
                </div>
            </a>
        </div>
    </div>

    <!-- Assigned Tasks List -->
    <div class="card mt-4 p-3 shadow-sm">
        <h4 class="mb-3">My Tasks @if(request('status')) ({{ ucfirst(request('status')) }}) @endif</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
               <tbody>
@forelse($assignedTasks as $task)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $task->title }}</td>
    <td>{{ $task->project->name ?? $task->project->title ?? 'N/A' }}</td>
    <td>
        @if($task->status == 'approved')
            <span class="badge bg-success">Approved</span>
        @elseif($task->status == 'pending')
            <span class="badge bg-warning text-dark">Pending</span>
        @elseif($task->status == 'under_review')
            <span class="badge bg-primary">Under Review</span>
        @elseif($task->status == 'rejected')
            <span class="badge bg-danger">Rejected</span>
        @else
            <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
        @endif
    </td>
    <td>{{ $task->due_date ?? 'N/A' }}</td>
    <td>
        <a href="{{ route('employee.tasks.show', $task) }}" class="btn btn-sm btn-info mb-1">View</a>

        @if($task->status === 'pending')
        <form method="POST" action="{{ route('tasks.start',$task) }}" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-primary mb-1">Start</button>
        </form>
        @endif

        @if(in_array($task->status, ['pending','in_progress']))
        <form method="POST" action="{{ route('tasks.complete',$task) }}" class="d-inline">
            @csrf
            <input class="form-control form-control-sm mb-1" name="remarks" placeholder="Work done (optional)">
            <button class="btn btn-sm btn-success">Submit</button>
        </form>
        @endif
    </td>
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

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
</style>
@endsection
