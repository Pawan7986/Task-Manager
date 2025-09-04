@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Registered Users</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Email Verified</th>
            </tr>
        </thead>
       <tbody>
    @forelse($users as $user)
        <tr onclick="window.location='{{ route('admin.users.show', $user->id) }}'" style="cursor:pointer;">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                @if($user->status == 'active')
                    <span class="badge bg-success">Active</span>
                @elseif($user->status == 'inactive')
                    <span class="badge bg-warning">Inactive</span>
                @else
                    <span class="badge bg-danger">Banned</span>
                @endif
            </td>
            <td>
                @if($user->email_verified_at)
                     Verified
                @else
                     Not Verified
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No users found.</td>
        </tr>
    @endforelse
</tbody>

    </table>

    <!-- Pagination -->
    <div>
        {{ $users->links() }}
    </div>
</div>
@endsection
