@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="post-card">
        <div style="margin-bottom: 24px;">
            <a href="{{ route('posts.index') }}" class="btn btn-outline">← Back to Posts</a>
        </div>

        <h1 style="font-size: 32px; font-weight: 600; color: #f0f6fc; margin-bottom: 24px;">{{ $post->title }}</h1>

        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 24px;">
        @endif

        <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 16px;">
            @if($post->category)
                <a href="{{ route('posts.index', ['category_id' => $post->category->id]) }}" class="post-category category-{{ strtolower(str_replace(' ', '-', $post->category->name ?? 'general')) }}">
                    {{ strtoupper($post->category->name) }}
                </a>
            @endif
            <span style="color: #8b949e; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
                {{ $post->views }} {{ Str::plural('view', $post->views) }}
            </span>
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