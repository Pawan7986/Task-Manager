@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Email Verification Required</h2>
    <p>
        Please check your email to verify your account. 
        If you did not receive the email, you can request another.
    </p>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>
</div>
@endsection
