@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Tasks @if(request()->query('status')) ({{ ucfirst(request()->query('status')) }}) @endif</h2>

    <!-- Tasks Table -->
    <div class="card p-3 shadow-sm">
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
                    <td>{{ $task->project->name ?? $task->project->title }}</td>
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
@endsection
