@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <div class="form-container">
        <h1 style="font-size: 24px; font-weight: 600; color: #f0f6fc; margin-bottom: 24px;">Edit Tag</h1>
        
        <form action="{{ route('tags.update', $tag) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') error @enderror" value="{{ old('name', $tag->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">Update Tag</button>
                <a href="{{ route('tags.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection