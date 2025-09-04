@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">👤 User Profile</h2>

    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        <div class="card-header bg-dark text-white d-flex align-items-center">
            <div class="me-3">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:50px; height:50px; font-size:20px;">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>
            </div>
            <div>
                <h5 class="mb-0">{{ $user->name }}</h5>
                <small class="text-light">
                    {{ ucfirst($user->role) }}
                </small>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>📧 Email:</strong> {{ $user->email }}</p>
                    <p>
                        <strong>📌 Status:</strong>
                        @if($user->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($user->status == 'inactive')
                            <span class="badge bg-warning text-dark">Inactive</span>
                        @else
                            <span class="badge bg-danger">Banned</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>🆔 User ID:</strong> {{ $user->id }}</p>
                    <p><strong>✅ Email Verified:</strong> 
                        {{ $user->email_verified_at ? 'Yes' : 'No' }}
                    </p>
                </div>
            </div>

            <!-- Status Change Form -->
            <div class="mt-4">
                <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="d-flex">
                    @csrf
                    <select name="status" class="form-select me-2" style="max-width: 200px;">
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="banned" {{ $user->status == 'banned' ? 'selected' : '' }}>Banned</option>
                    </select>
                    <button type="submit" class="btn btn-gradient-primary">
                        🔄 Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            ⬅ Back to Users
        </a>
    </div>
</div>

<!-- Extra CSS for gradient button -->
<style>
.btn-gradient-primary {
    background: linear-gradient(90deg, #4e73df, #1cc88a);
    color: #fff;
    border: none;
    transition: 0.3s;
}
.btn-gradient-primary:hover {
    background: linear-gradient(90deg, #1cc88a, #4e73df);
    color: #fff;
}
</style>
@endsection
