@extends('layouts.app')

@section('title','Admin Reports')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Admin Reports</h2>

    <!-- Employees Section -->
    <h3 class="mb-3">Employees Overview</h3>
    <div class="row">
        @foreach($users as $u)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ $u->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $u->email }}</h6>
                        <p class="mb-2">Total Tasks: <b>{{ $u->assigned_tasks_count }}</b></p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success">Approved: {{ $u->approved_count }}</span>
                            <span class="badge bg-warning text-dark">Under Review: {{ $u->under_review_count }}</span>
                            <span class="badge bg-primary">In Progress: {{ $u->in_progress_count }}</span>
                            <span class="badge bg-secondary">Pending: {{ $u->pending_count }}</span>
                            <span class="badge bg-danger">Rejected: {{ $u->rejected_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Projects Section -->
    <h3 class="mt-4 mb-3">Projects Overview</h3>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Project</th>
                        <th>Total Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->tasks_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
