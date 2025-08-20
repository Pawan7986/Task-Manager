@extends('layouts.app')

@section('content')
<h2 class="mb-4">Projects</h2>

<!-- Create New Project -->
<div class="card mb-4 p-4 shadow-sm border-start border-4 border-primary rounded-3">
    <h5 class="mb-3">Create New Project</h5>
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="mb-2">
            <input class="form-control" name="name" placeholder="Project name" required>
        </div>
        <div class="mb-2">
            <input class="form-control" name="description" placeholder="Description">
        </div>
        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>

@foreach($projects as $project)
<div class="card mb-4 shadow-sm border-start border-4 border-info rounded-3 hover-shadow p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1">{{ $project->name }}</h4>
            <p class="text-muted mb-0">{{ $project->description }}</p>
        </div>
        <button class="btn btn-outline-secondary" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#assignTask{{ $project->id }}" 
                aria-expanded="false" 
                aria-controls="assignTask{{ $project->id }}">
            Assign New Task
        </button>
    </div>

    <!-- Collapsible Assign Task Form -->
  

<div class="collapse mt-2" id="assignTask{{ $project->id }}">
    <form method="POST" action="{{ route('tasks.store') }}" class="p-3 border rounded bg-light">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input class="form-control mb-2" name="title" placeholder="Task title" required>
        <input class="form-control mb-2" name="description" placeholder="Task description">
        <input class="form-control mb-2" name="due_date" type="datetime-local">
        <select class="form-select mb-2" name="assigned_to" required>
            <option value="">Assign to…</option>
            @foreach(\App\Models\User::where('role','employee')->get() as $emp)
                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">Assign Task</button>
    </form>
</div>


    <!-- Project Tasks Table -->
   <div class="table-responsive mt-3">
    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>Task</th>
                <th>Employee</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->employee->name ?? '-' }}</td>
                <td>
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
                </td>
                <td>{{ $task->due_date ?? '-' }}</td>
                <td>{{ $task->remarks ?? '-' }}</td>
                <td class="d-flex justify-content-center align-items-center flex-wrap gap-1">
                    
                    {{-- Admin Review Form --}}
                    @if($task->status === 'under_review')
                        <form method="POST" action="{{ route('tasks.review',$task) }}" class="d-flex flex-column gap-1 mb-1">
                            @csrf
                            <input class="form-control form-control-sm" name="remarks" placeholder="Admin feedback" value="{{ $task->remarks }}">
                            <div class="d-flex gap-1 mt-1">
                                <button name="decision" value="approved" class="btn btn-sm btn-success">Approve</button>
                                <button name="decision" value="rejected" class="btn btn-sm btn-danger">Reject</button>
                            </div>
                        </form>
                    @endif

                    {{-- View Button --}}
                    <a href="{{ route('tasks.show2', $task) }}" class="btn btn-sm btn-info mb-1">View</a>

                    {{-- Delete Button --}}
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger mb-1">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>
@endforeach

<!-- Card Hover Effect -->
<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}
</style>
@endsection
