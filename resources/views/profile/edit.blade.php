@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <h2 class="mb-4 text-center">My Profile</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Update User Info --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">Update Profile Details</div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update Details</button>
            </form>
        </div>
    </div>

    {{-- Update Password --}}
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">Change Password</div>
        <div class="card-body">
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning">Update Password</button>
            </form>
        </div>
    </div>
@endsection
