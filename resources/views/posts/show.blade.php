@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="form-container">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('posts.index') }}" class="btn btn-outline">← Back to Posts</a>
        </div>

        <h1 style="font-size: 32px; font-weight: 600; color: #f0f6fc; margin-bottom: 24px;">{{ $post->title }}</h1>

        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 24px;">
        @endif

        <div style="margin-bottom: 24px;">
            @if($post->category)
                <a href="{{ route('posts.index', ['category_id' => $post->category->id]) }}" class="post-category">
                    {{ $post->category->name }}
                </a>
            @endif
        </div>

        @if($post->tags->count() > 0)
            <div style="margin-bottom: 24px;">
                <div class="post-tags">
                    @foreach($post->tags as $tag)
                        <a href="{{ route('posts.index', ['tags[]' => $tag->id]) }}" class="tag">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div style="color: #e6edf3; line-height: 1.7; font-size: 16px;">
            {!! nl2br(e($post->content)) !!}
        </div>

        @auth
            <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #30363d; display: flex; gap: 12px;">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit Post</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete Post</button>
                </form>
            </div>
        @endauth
    </div>
@endsection