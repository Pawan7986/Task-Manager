@extends('layouts.app')

@section('content')
<h2>My Task Report</h2>

<div class="row mb-3">
    <div class="col-md-2"><div class="card text-center p-2 bg-light">Total<br><b>{{ $stats['total'] }}</b></div></div>
    <div class="col-md-2"><div class="card text-center p-2 bg-success text-white">Approved<br><b>{{ $stats['approved'] }}</b></div></div>
    <div class="col-md-2"><div class="card text-center p-2 bg-warning text-dark">Under Review<br><b>{{ $stats['under_review'] }}</b></div></div>
    <div class="col-md-2"><div class="card text-center p-2 bg-primary text-white">In Progress<br><b>{{ $stats['in_progress'] }}</b></div></div>
    <div class="col-md-2"><div class="card text-center p-2 bg-secondary text-white">Pending<br><b>{{ $stats['pending'] }}</b></div></div>
    <div class="col-md-2"><div class="card text-center p-2 bg-danger text-white">Rejected<br><b>{{ $stats['rejected'] }}</b></div></div>
</div>

<h3>Recent Tasks</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Task</th>
            <th>Project</th>
            <th>Status</th>
            <th>Remarks</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recent as $t)
        <tr>
            <td>{{ $t->title }}</td>
            <td>{{ $t->project->name }}</td>
            <td>{{ ucfirst($t->status) }}</td>
            <td>{{ $t->remarks ?? '-' }}</td>
            <td>{{ $t->due_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
