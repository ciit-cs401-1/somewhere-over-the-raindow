@extends('layouts.app')

@section('title', 'General Settings')

@section('content')
<div class="profile-container">
    <h1 class="section-title">General Settings</h1>

    {{-- Accordion for Settings --}}
    <div class="settings-accordion">
        {{-- Profile Settings Section --}}
        <div class="settings-category">
            <div class="settings-category-header collapsible-trigger" data-target="#profile-settings-content">
                <h2 class="settings-category-title">Profile Settings</h2>
                <span class="collapse-icon">+</span>
            </div>
            <div id="profile-settings-content" class="collapsible-content">
                {{-- Update Profile Information --}}
                <div class="profile-section">
                    <h3>Profile Information</h3>
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
                    <h3>Update Password</h3>
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
                    <h3>Delete Account</h3>
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
        </div>

        {{-- Notifications Settings Section --}}
        <div class="settings-category">
            <div class="settings-category-header collapsible-trigger" data-target="#notifications-settings-content">
                <h2 class="settings-category-title">Notifications</h2>
                <span class="collapse-icon">+</span>
            </div>
            <div id="notifications-settings-content" class="collapsible-content">
                <p class="mb-4">Manage the email notifications you receive.</p>
                <div class="form-group-toggle">
                    <label for="comments-notification">Comments on your posts</label>
                    <label class="switch">
                        <input type="checkbox" id="comments-notification" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="form-group-toggle">
                    <label for="replies-notification">Replies to your comments</label>
                    <label class="switch">
                        <input type="checkbox" id="replies-notification" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div class="form-group-toggle">
                    <label for="newsletter-notification">Weekly newsletter</label>
                    <label class="switch">
                        <input type="checkbox" id="newsletter-notification">
                        <span class="slider round"></span>
                    </label>
                </div>
                 <button type="submit" class="btn btn-primary mt-4">Save Notifications</button>
            </div>
        </div>

        {{-- Social Profiles Section --}}
        <div class="settings-category">
            <div class="settings-category-header collapsible-trigger" data-target="#social-profiles-content">
                <h2 class="settings-category-title">Social Profiles</h2>
                <span class="collapse-icon">+</span>
            </div>
            <div id="social-profiles-content" class="collapsible-content">
                 <p class="mb-4">Add your social media links to be displayed on your profile.</p>
                <form method="post" action="#" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="twitter_url">Twitter URL</label>
                        <input type="url" id="twitter_url" name="twitter_url" class="form-control" placeholder="https://twitter.com/username">
                    </div>
                    <div class="form-group">
                        <label for="linkedin_url">LinkedIn URL</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div class="form-group">
                        <label for="github_url">GitHub URL</label>
                        <input type="url" id="github_url" name="github_url" class="form-control" placeholder="https://github.com/username">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Social Links</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
