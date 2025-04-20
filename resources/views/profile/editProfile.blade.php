@extends('layouts.app')
@section('title', 'HyperHeaven - Order History')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        @method('PATCH')
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <hr>

    <div class="form-group mb-3">
        <label>New Password <small class="text-muted">(leave blank if not changing)</small></label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection

