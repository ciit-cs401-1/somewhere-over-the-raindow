@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <!-- Categories Header -->
    <div class="posts-header">
        <div class="posts-header-left">
            @if (!$categories->onFirstPage())
                <a href="{{ $categories->previousPageUrl() }}" class="nav-arrow" title="Previous Page">&laquo;</a>
            @else
                <span class="nav-arrow disabled">&laquo;</span>
            @endif
            <h2>Categories</h2>
        </div>

        <div class="posts-header-right">
            @auth
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
            @endauth
            @if ($categories->hasMorePages())
                <a href="{{ $categories->nextPageUrl() }}" class="nav-arrow" title="Next Page">&raquo;</a>
            @else
                <span class="nav-arrow disabled">&raquo;</span>
            @endif
        </div>
    </div>

    @if($categories->count())
        <!-- Categories Grid -->
        <div class="posts-grid">
            @foreach($categories as $category)
                <article class="post-card category-card category-{{ strtolower(str_replace(' ', '-', $category->name ?? 'general')) }}">
                    <h3 class="post-title">{{ $category->name }}</h3>
                    <div class="post-meta">
                        <span class="post-views">{{ $category->posts_count ?? $category->posts->count() }} posts</span>
                    </div>
                    <div class="category-description">
                        {{ $category->description }}
                    </div>
                    @auth
                        <div class="post-actions" style="margin-top: 16px; display: flex; gap: 8px;">
                            @can('update', $category)
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                            @endcan
                            @can('delete', $category)
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this category?');">
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
        <div class="alert alert-info">
            <p>No categories found.</p>
        </div>
    @endif

    @if (Auth::guest())
        <div class="alert alert-info">
            To create, edit, or delete categories, <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a>.
        </div>
    @endif
<style>
    .category-card .post-title,
    .category-card .post-meta,
    .category-card .category-description {
        color: var(--white) !important;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }

    .category-card .post-title {
        font-size: 1.75rem;
    }

    .category-card .category-description {
        color: rgba(255, 255, 255, 0.85) !important;
        font-size: 14px;
        line-height: 1.5;
    }
</style>

@endsection

@push('styles')
<style>
    .category-business {
        background: #8e44ad !important; /* Purple */
    }
    .category-travel {
        background: #3498db !important; /* Blue */
    }
    .category-card .post-title,
    .category-card .post-meta,
    .category-card .category-description {
        color: var(--white) !important;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }
    .category-card .category-description {
        color: rgba(255, 255, 255, 0.85) !important;
    }
</style>
@endpush 