@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="form-container-transparent">
        <h1 style="font-size: 24px; font-weight: 600; color: #f0f6fc; margin-bottom: 24px;">Create New Post</h1>
        
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('posts._form')
            
            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">Create Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection