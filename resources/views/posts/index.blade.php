@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <!-- Featured Section -->
    <div class="featured-section">
        <div class="section-header">
            <h1 class="section-title">Latest</h1>
            <a href="{{ route('posts.index') }}" class="view-all">View latest</a>
        </div>
        
        <div class="featured-grid">
            @if($posts->count() > 0)
                <!-- Featured Main Post -->
                <div class="featured-main">
                    <div class="featured-category">
                        @if($posts->first()->category)
                            {{ strtoupper($posts->first()->category->name) }}
                        @else
                            FEATURED
                        @endif
                    </div>
                    <h2 class="featured-title">
                        <a href="{{ route('posts.show', $posts->first()) }}" style="color: white; text-decoration: none;">
                            {{ $posts->first()->title }}
                        </a>
                    </h2>
                    <p class="featured-description">
                        {{ Str::limit($posts->first()->content, 150) }}
                    </p>
                </div>

                <!-- Featured Sidebar Posts -->
                <div class="featured-sidebar">
                    @foreach($posts->skip(1)->take(4) as $post)
                        <div class="post-card">
                            <div class="post-image"></div>
                            <div class="post-content">
                                <div class="post-category">
                                    @if($post->category)
                                        {{ strtoupper($post->category->name) }}
                                    @else
                                        GENERAL
                                    @endif
                                </div>
                                <h3 class="post-title">
                                    <a href="{{ route('posts.show', $post) }}" style="color: inherit; text-decoration: none;">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <div class="post-meta">
                                    <span class="post-views">{{ rand(100, 2000) }} views</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Filters -->
    <div class="filters">
        <h3>Filter Posts</h3>
        <form method="GET" action="{{ route('posts.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="filter-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label for="tags">Tags</label>
                    <div class="multi-select-dropdown">
                        <div class="multi-select-display" onclick="toggleTagsDropdown()">
                            <span class="selected-tags">
                                @if(request('tags'))
                                    {{ count(request('tags')) }} tag(s) selected
                                @else
                                    All Tags
                                @endif
                            </span>
                            <span class="dropdown-arrow">▼</span>
                        </div>
                        <div class="multi-select-options" id="tagsDropdown">
                            @foreach($tags as $tag)
                                <label class="multi-select-option">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                           {{ in_array($tag->id, request('tags', [])) ? 'checked' : '' }}
                                           onchange="updateSelectedTags()">
                                    <span class="tag-label">#{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline">Clear Filters</a>
                </div>
            </div>
        </form>
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
                    <div class="post-image"></div>
                    <div class="post-content">
                        <div class="post-category">
                            @if($post->category)
                                {{ strtoupper($post->category->name) }}
                            @else
                                GENERAL
                            @endif
                        </div>
                        <h3 class="post-title">
                            <a href="{{ route('posts.show', $post) }}" style="color: inherit; text-decoration: none;">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <div class="post-meta">
                            <span class="post-views">{{ rand(100, 2000) }} views</span>
                        </div>
                        @auth
                            <div class="post-actions" style="margin-top: 16px; display: flex; gap: 8px;">
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary" style="font-size: 12px; padding: 4px 8px;">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $posts->links() }}
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

    <style>
        /* Multi-Select Dropdown Styles */
        .multi-select-dropdown {
            position: relative;
            display: inline-block;
        }

        .multi-select-display {
            background-color: #0d1117;
            color: #e6edf3;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 12px;
            font-size: 14px;
            min-width: 150px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s ease;
        }

        .multi-select-display:hover {
            border-color: #667eea;
        }

        .dropdown-arrow {
            font-size: 10px;
            color: #8b949e;
            transition: transform 0.2s ease;
        }

        .multi-select-options {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 6px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            margin-top: 4px;
            max-height: 200px;
            overflow-y: auto;
        }

        .multi-select-option {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #30363d;
        }

        .multi-select-option:last-child {
            border-bottom: none;
        }

        .multi-select-option:hover {
            background-color: #21262d;
        }

        .multi-select-option input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #667eea;
        }

        .tag-label {
            color: #e6edf3;
            font-size: 14px;
        }

        .selected-tags {
            color: #e6edf3;
        }

        .filter-buttons {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }
    </style>

    <script>
        function toggleTagsDropdown() {
            const dropdown = document.getElementById('tagsDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        function updateSelectedTags() {
            const checkboxes = document.querySelectorAll('input[name="tags[]"]:checked');
            const display = document.querySelector('.selected-tags');
            
            if (checkboxes.length === 0) {
                display.textContent = 'All Tags';
            } else {
                display.textContent = `${checkboxes.length} tag(s) selected`;
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.multi-select-dropdown');
            if (!dropdown.contains(event.target)) {
                document.getElementById('tagsDropdown').style.display = 'none';
            }
        });
    </script>
@endsection 