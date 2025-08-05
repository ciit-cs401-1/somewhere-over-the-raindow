@extends('layouts.app')

@section('title', 'Posts')

@section('content')
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
                    <a href="{{ route('posts.index') }}" class="clear-filters">Clear Filters</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Posts Header -->
    <div class="posts-header">
        <h2>Latest Posts</h2>
        <span class="posts-count">{{ $posts->count() }} posts found</span>
    </div>

    @if($posts->count())
        <!-- Posts Grid -->
        <div class="posts-grid">
            @foreach($posts as $post)
                <article class="post-card">
                    <a href="{{ route('posts.show', $post) }}" class="post-title">{{ $post->title }}</a>
                    <div class="post-meta">
                        @if($post->category)
                            <a href="{{ route('posts.index', ['category_id' => $post->category->id]) }}" class="post-category">
                                {{ $post->category->name }}
                            </a>
                        @endif
                        <span class="post-views">{{ rand(100, 2000) }} views</span>
                    </div>
                    <div class="post-tags">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('posts.index', ['tags[]' => $tag->id]) }}" class="tag">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                    @auth
                        <div class="post-actions" style="margin-top: 16px; display: flex; gap: 8px;">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning" style="font-size: 12px; padding: 4px 8px;">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this post?');">
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