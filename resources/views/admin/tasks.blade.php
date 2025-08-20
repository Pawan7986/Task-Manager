@extends('layouts.app')

@section('title','Admin Tasks')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <h2 class="mb-4">Tasks (Total: {{ $totalTasks }})</h2>

            <!-- Success message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Create Task Button -->
            <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create New Task</a>

            <!-- Task List Table -->
            <div class="card p-3">
                <h4>All Tasks</h4>
                <table class="table table-bordered mt-2">
                    <thead>
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
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->project->title }}</td>
                            <td>{{ $task->employee ? $task->employee->name : 'N/A' }}</td>
                            <td>{{ ucfirst($task->status) }}</td>
                            <td>{{ $task->due_date ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
