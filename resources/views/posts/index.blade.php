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
        <span class="view-all">{{ $posts->count() }} posts found</span>
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