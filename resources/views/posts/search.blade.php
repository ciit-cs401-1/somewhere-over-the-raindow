@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <!-- Posts Header -->
    <div class="section-header" style="margin-top: 2rem;">
        <h2 class="section-title">You searched for: "{{ request('search') }}"</h2>
        <span class="view-all">{{ $posts->total() }} posts found</span>
    </div>

    @if($posts->count())
        <!-- Posts Grid -->
        <div class="posts-grid">
            @foreach($posts as $post)
                <div class="post-card">
                    <a href="{{ route('posts.show', $post) }}" class="post-image-link">
                        <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://placehold.co/600x400/34495e/ecf0f1?text=' . urlencode($post->title) }}" alt="{{ $post->title }}" class="post-image">
                    </a>
                    <div class="post-content">
                        <div class="post-category category-{{ strtolower(str_replace(' ', '-', $post->category->name ?? 'general')) }}">
                            {{ strtoupper($post->category->name ?? 'GENERAL') }}
                        </div>
                        <h3 class="post-title">
                            <a href="{{ route('posts.show', $post) }}" style="color: inherit; text-decoration: none;">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <div class="card-footer">
                            @if($post->tags->count() > 0)
                                <div class="post-tags">
                                    @foreach($post->tags->take(3) as $tag)
                                        <span class="tag-label">#{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{-- <div class="pagination">
            {{ $posts->appends(request()->query())->links() }}
        </div> --}}
    @else
        <div class="alert alert-info">
            <p>No posts found for your search term "{{ request('search') }}".</p>
        </div>
    @endif

@endsection
