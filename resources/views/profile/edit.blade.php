@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="profile-container">
    <h1 class="section-title">Profile Settings</h1>

    {{-- Update Profile Information --}}
    <div class="profile-section">
        <h2>Profile Information</h2>
        <p>Update your account's profile information and email address.</p>
        <form method="post" action="{{ route('profile.update') }}" class="mt-4">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            @if (session('status') === 'profile-updated')
                <span class="success-message ml-2">Saved.</span>
            @endif
        </form>
    </div>

    {{-- Update Password --}}
    <div class="profile-section">
        <h2>Update Password</h2>
        <p>Ensure your account is using a long, random password to stay secure.</p>
        <form method="post" action="{{ route('password.update') }}" class="mt-4">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                @error('current_password', 'updatePassword')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password', 'updatePassword')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            @if (session('status') === 'password-updated')
                <span class="success-message ml-2">Saved.</span>
            @endif
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="profile-section">
        <h2>Delete Account</h2>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        <form method="post" action="{{ route('profile.destroy') }}" class="mt-4" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            @csrf
            @method('delete')
            <p class="mb-2">To confirm, please enter your password.</p>
            <div class="form-group">
                <label for="delete_password">Password</label>
                <input type="password" id="delete_password" name="password" class="form-control" required>
                 @error('password', 'userDeletion')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </form>
    </div>
</div>
@endsection
