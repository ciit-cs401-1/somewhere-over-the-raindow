@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <!-- Tags Header -->
    <div class="posts-header">
        <div class="posts-header-left">
            @if (!$tags->onFirstPage())
                <a href="{{ $tags->previousPageUrl() }}" class="nav-arrow" title="Previous Page">&laquo;</a>
            @else
                <span class="nav-arrow disabled">&laquo;</span>
            @endif
            <h2>Tags</h2>
        </div>

        <div class="posts-header-right">
            @auth
                <a href="{{ route('tags.create') }}" class="btn btn-primary">Create New Tag</a>
            @endauth
            @if ($tags->hasMorePages())
                <a href="{{ $tags->nextPageUrl() }}" class="nav-arrow" title="Next Page">&raquo;</a>
            @else
                <span class="nav-arrow disabled">&raquo;</span>
            @endif
        </div>
    </div>

    @if($tags->count())
        <!-- Tags Grid -->
        <div class="posts-grid">
            @foreach($tags as $tag)
                <article class="post-card">
                    <h3 class="post-title">#{{ $tag->name }}</h3>
                    <div class="post-meta">
                        <span class="post-views">{{ $tag->posts_count ?? $tag->posts->count() }} posts</span>
                    </div>
                    @auth
                        <div class="post-actions" style="margin-top: 16px; display: flex; gap: 8px;">
                            @can('update', $tag)
                                <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                            @endcan
                            @can('delete', $tag)
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this tag?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" style="font-size: 12px; padding: 4px 8px;">Delete</button>
                                </form>
                            @endcan
                        </div>
                    @endauth
                </article>
            @endforeach
        </div>


    @else
        <div class="post-card">
            <p>No tags found.</p>
        </div>
    @endif

    @if (Auth::guest())
        <div class="alert alert-info">
            To create, edit, or delete tags, <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a>.
        </div>
    @endif
@endsection 