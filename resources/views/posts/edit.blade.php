@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="form-container">
        <h1 style="font-size: 24px; font-weight: 600; color: #f0f6fc; margin-bottom: 24px;">Edit Post</h1>
        
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('posts._form')
            
            <div style="margin-top: 24px; display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
@endsection