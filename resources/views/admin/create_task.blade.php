@extends('layouts.app')

@section('title','Create Task')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Task</h2>

    <div class="card p-3">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label>Project</label>
                    <select name="project_id" class="form-control" required>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-2">
                    <label>Assign to</label>
                    <select name="assigned_to" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-2">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-2">
                <label>Due Date</label>
                <input type="date" name="due_date" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary mt-2">Assign Task</button>
        </form>
    </div>
</div>
@endsection
