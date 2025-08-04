@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <h2>Blog Posts</h2>
    
    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="post-card">
                <h3>
                    <a href="{{ route('posts.show', $post) }}" class="post-title">
                        {{ $post->title }}
                    </a>
                </h3>
                
                <div class="post-meta">
                    <strong>Category:</strong> 
                    <a href="{{ route('categories.show', $post->category) }}">
                        {{ $post->category->name }}
                    </a>
                    | 
                    <strong>Author:</strong> {{ $post->user->name }}
                    | 
                    <strong>Published:</strong> {{ $post->created_at->format('M d, Y') }}
                </div>
                
                @if($post->excerpt)
                    <p>{{ $post->excerpt }}</p>
                @endif
                
                @if($post->tags->count() > 0)
                    <div class="post-meta">
                        <strong>Tags:</strong>
                        @foreach($post->tags as $tag)
                            <span class="tag">
                                <a href="{{ route('tags.show', $tag) }}" style="color: white; text-decoration: none;">
                                    {{ $tag->name }}
                                </a>
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
        
        <div style="margin-top: 30px;">
            {{ $posts->links() }}
        </div>
    @else
        <p>No posts found.</p>
    @endif
    
    <div style="margin-top: 30px;">
        <a href="{{ route('posts.create') }}" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
            Create New Post
        </a>
    </div>
@endsection 