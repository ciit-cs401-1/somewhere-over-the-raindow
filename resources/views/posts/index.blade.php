@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <!-- Hero Slider Header -->
    <div class="section-header">
        <h2 class="section-title">Hot Topics</h2>
    </div>

    <!-- Hero Slider Section -->
    <div class="hero-slider-container">
        <!-- Swiper -->
        <div class="swiper-container hero-swiper">
            <div class="swiper-wrapper">
                @foreach($posts->take(5) as $post) <!-- Limiting to 5 for the hero slider -->
                <div class="swiper-slide">
                    <div class="slide-background" style="background-image: url('{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://placehold.co/1600x900/34495e/ecf0f1?text=' . urlencode($post->category->name ?? 'Blog Post') }}');"></div>
                    <div class="slide-content">
                        <div class="info-box">
                            <a href="{{ route('posts.index', ['category_id' => $post->category->id]) }}" class="post-category category-{{ strtolower(str_replace(' ', '-', $post->category->name ?? 'general')) }}" style="text-decoration: none;">
                                {{ strtoupper($post->category->name ?? 'GENERAL') }}
                            </a>
                            <h2 class="slide-title">{{ $post->title }}</h2>
                            <p class="slide-excerpt">{{ Str::limit($post->excerpt, 150) }}</p>
                            @if($post->tags->count() > 0)
                                <div class="post-tags" style="margin-bottom: 16px;">
                                    @foreach($post->tags->take(3) as $tag)
                                        <a href="{{ route('posts.index', ['tags[]' => $tag->id]) }}" class="tag-label" style="text-decoration: none; background-color: #21262d; padding: 4px 10px; border-radius: 15px; font-size: 12px;">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>



    <!-- Posts Header -->
    <div class="section-header">
        <h2 class="section-title">All Posts</h2>
        <div style="display: flex; align-items: center; gap: 1rem;">
            @auth
                <a href="{{ route('posts.create') }}" class="btn btn-primary" style="text-decoration: none;">Create Post</a>
            @endauth
            <span class="view-all">{{ $posts->count() }} posts found</span>
        </div>
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
                        <a href="{{ route('posts.index', ['category_id' => $post->category->id]) }}" class="post-category category-{{ strtolower(str_replace(' ', '-', $post->category->name ?? 'general')) }}" style="text-decoration: none;">
                            {{ strtoupper($post->category->name ?? 'GENERAL') }}
                        </a>
                        <h3 class="post-title">
                            <a href="{{ route('posts.show', $post) }}" style="color: inherit; text-decoration: none;">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <div class="post-meta">
                            <span>By {{ $post->user->name }}</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            <span style="display: flex; align-items: center; gap: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                                {{ $post->views }}
                            </span>
                            @auth
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <span style="color: #8b949e; font-size: 14px;">{{ $post->likes->count() }}</span>
                                    @if ($post->likes()->where('user_id', Auth::id())->exists())
                                        <form action="{{ route('posts.unlike', $post) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link" style="padding: 0; border: none; background: none; cursor: pointer; color: #f85149;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.like', $post) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-link" style="padding: 0; border: none; background: none; cursor: pointer; color: #8b949e;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-1.113 2.175-.229 4.878 2.458 7.372L8 14.014l.737-10.425c2.688-2.494 3.572-5.197 2.458-7.372C12.514.878 9.4.281 7.283 2.01L8 2.748zm0 1.518-1.01-1.038C4.93-1.43 1.022.52 0 3.133-1.022 5.746.936 8.25 4.796 11.01L8 13.502l3.204-2.492c3.86-2.76 5.818-5.266 4.796-7.879-1.022-2.613-4.93-4.563-6.213-2.585L8 4.266z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                        </div>
                        <div class="card-footer">
                            @if($post->tags->count() > 0)
                                <div class="post-tags">
                                    @foreach($post->tags->take(3) as $tag)
                                        <a href="{{ route('posts.index', ['tags[]' => $tag->id]) }}" class="tag-label" style="text-decoration: none;">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    @else
        <div class="alert alert-info">
            <p>No posts found.</p>
        </div>
    @endif

    @if (Auth::guest())
        <div class="alert alert-info">
            To create, edit, or delete posts, <a href="{{ route('login') }}">log in</a> or <a href="{{ route('register') }}">register</a>.
        </div>
    @endif

    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.hero-swiper', {
            // Optional parameters
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
@endpush

@endsection 