@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <h2>Tags</h2>
    
    @if($tags->count() > 0)
        @foreach($tags as $tag)
            <div class="post-card">
                <h3>
                    <a href="{{ route('tags.show', $tag) }}" class="post-title">
                        {{ $tag->name }}
                    </a>
                </h3>
                
                <div class="post-meta">
                    <strong>Posts:</strong> {{ $tag->posts_count }}
                </div>
            </div>
        @endforeach
        
        <div style="margin-top: 30px;">
            {{ $tags->links() }}
        </div>
    @else
        <p>No tags found.</p>
    @endif
    
    <div style="margin-top: 30px;">
        <a href="{{ route('tags.create') }}" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
            Create New Tag
        </a>
    </div>
@endsection 