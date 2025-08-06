@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <!-- Categories Header -->
    <div class="posts-header">
        <h2>Categories</h2>
        @auth
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
        @endauth
    </div>

    @if($categories->count())
        <!-- Categories Grid -->
        <div class="posts-grid">
            @foreach($categories as $category)
                <article class="post-card">
                    <h3 class="post-title">{{ $category->name }}</h3>
                    <div class="post-meta">
                        <span class="post-views">{{ $category->posts_count ?? $category->posts->count() }} posts</span>
                    </div>
                    <div style="color: #8b949e; font-size: 14px; line-height: 1.5;">
                        {{ $category->description }}
                    </div>
                    @auth
                        <div class="post-actions" style="margin-top: 16px; display: flex; gap: 8px;">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this category?');">
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
            {{ $categories->links() }}
        </div>
    @else
        <div class="alert alert-info">
            <p>No categories found.</p>
        </div>
    @endif

    @if (Auth::guest())
        <div class="alert alert-info">
            To create, edit, or delete categories, <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a>.
        </div>
    @endif
@endsection 