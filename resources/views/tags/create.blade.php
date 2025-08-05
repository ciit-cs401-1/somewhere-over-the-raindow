@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
    <div class="form-container">
        <h1 style="font-size: 24px; font-weight: 600; color: #f0f6fc; margin-bottom: 24px;">Create New Tag</h1>
        
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') error @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">Create Tag</button>
                <a href="{{ route('tags.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection