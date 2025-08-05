@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <!-- Tags Header -->
    <div class="posts-header">
        <h2>Tags</h2>
        @auth
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Create New Tag</a>
        @endauth
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
                            <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                            <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this tag?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" style="font-size: 12px; padding: 4px 8px;">Delete</button>
                            </form>
                        </div>
                    @endauth
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $tags->links() }}
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