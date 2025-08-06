<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Modern Blog Design CSS -->
        <style>
            /* Color palette from the word cloud image */
            :root {
                --brown-dark: #4e342e;
                --brown: #6d4c41;
                --brown-medium: #a1887f;
                --beige: #f5f5dc;
                --cream: #fff8e1;
                --yellow: #ffe082;
                --yellow-muted: #e6d97a;
                --blue: #7fa7c7;
                --blue-light: #b3cde3;
                --green: #bfcf8c;
                --gray: #bdbdbd;
                --gray-dark: #757575;
            }

            body, .main-content {
                color: var(--brown-dark);
            }

            .header, .category-nav {
                background: rgba(245, 245, 220, 0.95); /* beige/cream */
                color: var(--brown-dark);
                border-bottom: 1.5px solid var(--brown-medium);
            }
            .header .logo {
                color: var(--brown-dark);
            }
            .header .logo-icon {
                background: var(--gray);
                color: var(--brown-dark);
            }
            .nav-links a {
                color: var(--brown-dark);
            }
            .nav-links a.active, .nav-links a:hover {
                color: var(--yellow);
                background: rgba(255, 224, 130, 0.12);
            }
            .nav-right .btn-outline {
                color: var(--blue);
                border-color: var(--blue);
                background: transparent;
            }
            .nav-right .btn-outline:hover {
                background: var(--blue);
                color: var(--cream);
            }
            .nav-right .btn-primary {
                background: var(--yellow);
                color: var(--brown-dark);
                border-color: var(--yellow);
            }
            .nav-right .btn-primary:hover {
                background: var(--yellow-muted);
                color: var(--brown-dark);
                border-color: var(--yellow);
            }
            .category-list a {
                color: var(--brown-dark);
            }
            .category-list a.active, .category-list a:hover {
                color: var(--blue);
                border-bottom-color: var(--blue);
            }

            /* Card and filter backgrounds */
            .post-card, .filters {
                background: rgba(245, 245, 220, 0.7); /* semi-transparent beige */
                border: 1.5px solid var(--brown-medium);
                color: var(--brown-dark);
            }
            .post-card:hover, .filters:focus-within {
                background: rgba(255, 248, 225, 0.9);
                border-color: var(--yellow);
            }
            .filters h3, .filters label, .filters .btn, .filters .filter-select, .filters .selected-tags, .filters .tag-label {
                color: var(--brown-dark) !important;
            }

            /* Headings */
            .section-title, .featured-title, .post-title {
                color: var(--brown-dark);
            }
            .featured-category, .post-category {
                color: var(--green);
                background: rgba(191, 207, 140, 0.18);
                border-radius: 8px;
                padding: 2px 10px;
                font-weight: 600;
                font-size: 13px;
                display: inline-block;
                margin-bottom: 8px;
            }
            /* Tag/label colors */
            .tag-label {
                color: var(--blue);
                background: rgba(127, 167, 199, 0.15);
                border-radius: 8px;
                padding: 2px 8px;
                font-size: 13px;
                margin-right: 4px;
            }
            /* Button colors */
            .btn {
                font-weight: 600;
                border-radius: 6px;
                border: 1.5px solid var(--brown-medium);
                background: var(--yellow);
                color: var(--brown-dark);
                transition: background 0.2s, color 0.2s;
            }
            .btn:hover {
                background: var(--blue);
                color: var(--cream);
                border-color: var(--blue);
            }
            /* Pagination */
            .pagination a, .pagination span {
                background: rgba(245, 245, 220, 0.7);
                color: var(--brown-dark);
                border: 1.5px solid var(--brown-medium);
            }
            .pagination a:hover, .pagination .current {
                background: var(--yellow);
                color: var(--brown-dark);
                border-color: var(--yellow);
            }
            /* Misc */
            .post-meta, .post-views {
                color: var(--gray-dark);
            }
            .multi-select-display, .multi-select-options {
                background: rgba(245, 245, 220, 0.7) !important;
                color: var(--brown-dark) !important;
                border: 1.5px solid var(--brown-medium) !important;
            }
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Noto Sans', Helvetica, Arial, sans-serif;
                background-color: #ffffff;
                color: #1a1a1a;
                line-height: 1.6;
                font-size: 16px;
                min-height: 100vh;
            }

            /* Header */
            .header {
                background: rgba(77, 54, 34, 0.97); /* warm brown */
                border-bottom: 1px solid #3e2723;
                padding: 20px 0;
                position: sticky;
                top: 0;
                z-index: 100;
                color: #f5f5dc;
                box-shadow: 0 2px 8px rgba(77,54,34,0.08);
            }

            .header-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .logo {
                font-size: 28px;
                font-weight: 700;
                color: #fff8e1;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .logo-icon {
                width: 32px;
                height: 32px;
                background: #bcaaa4;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #4e342e;
                font-weight: bold;
                font-size: 18px;
            }

            .nav-right {
                display: flex;
                align-items: center;
                gap: 24px;
            }

            .nav-links {
                display: flex;
                gap: 32px;
                list-style: none;
            }

            .nav-links a {
                color: #f5f5dc;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: color 0.2s ease;
            }
            .nav-links a.active, .nav-links a:hover {
                color: #ffe082;
                background: rgba(255,248,225,0.08);
            }

            .nav-links a:hover {
                color: #1a1a1a;
            }

            .search-icon {
                width: 20px;
                height: 20px;
                color: #666;
                cursor: pointer;
            }

            .btn {
                padding: 12px 24px;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.2s ease;
                border: 2px solid #1a1a1a;
                cursor: pointer;
                display: inline-block;
            }

            .btn-outline {
                color: #1a1a1a;
                background: transparent;
            }

            .btn-outline:hover {
                background-color: #1a1a1a;
                color: #ffffff;
            }

            .btn-primary {
                background-color: #1a1a1a;
                color: #ffffff;
                border-color: #1a1a1a;
            }

            .btn-primary:hover {
                background-color: #333;
                border-color: #333;
            }

            /* Category Navigation */
            .category-nav {
                background: rgba(77, 54, 34, 0.95);
                border-bottom: 1px solid #3e2723;
                padding: 16px 0;
                overflow-x: auto;
                color: #f5f5dc;
            }

            .category-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .category-list {
                display: flex;
                gap: 32px;
                list-style: none;
                white-space: nowrap;
            }

            .category-list a {
                color: #f5f5dc;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: color 0.2s ease;
                padding: 8px 0;
                border-bottom: 2px solid transparent;
            }
            .category-list a.active, .category-list a:hover {
                color: #ffe082;
                border-bottom-color: #ffe082;
            }

            /* Main Container - Full Screen Dark Background */
            .main-content {
                background: 
                    linear-gradient(rgba(20, 20, 20, 0.7), rgba(20, 20, 20, 0.7)),
                    url('/blog-wallpaper.jpg') center center / cover no-repeat;
                min-height: calc(100vh - 140px);
                color: #e6edf3;
                width: 100%;
                position: relative;
                overflow: hidden;
            }

            .main-content::before,
            .main-content::after {
                display: none !important;
            }

            /* Featured Section */
            .featured-section {
                margin-bottom: 60px;
                padding: 40px 20px;
                width: 100%;
                position: relative;
                z-index: 1;
            }

            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 32px;
                width: 100%;
                position: relative;
                z-index: 2;
            }

            .section-title {
                font-size: 32px;
                font-weight: 700;
                color: #f0f6fc;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .view-all {
                color: #8b949e;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                transition: color 0.3s ease;
            }

            .view-all:hover {
                color: #f0f6fc;
            }

            .featured-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 32px;
                align-items: start;
                width: 100%;
                position: relative;
                z-index: 2;
            }

            .featured-main {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 16px;
                padding: 40px;
                color: white;
                position: relative;
                overflow: hidden;
                min-height: 400px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(10px);
            }

            .featured-main::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
                opacity: 0.6;
            }

            .featured-category {
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 16px;
                opacity: 0.9;
            }

            .featured-title {
                font-size: 28px;
                font-weight: 700;
                margin-bottom: 16px;
                line-height: 1.2;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .featured-description {
                font-size: 16px;
                opacity: 0.9;
                line-height: 1.5;
            }

            .featured-sidebar {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 24px;
            }

            /* Post Cards */
            .post-card {
                background: rgba(77, 54, 34, 0.35); /* more transparent brown */
                border: 1.5px solid rgba(62, 39, 35, 0.5);
                border-radius: 12px;
                overflow: hidden;
                transition: all 0.3s ease;
                cursor: pointer;
                backdrop-filter: blur(18px);
                position: relative;
                z-index: 2;
                color: #f5f5dc;
            }

            .post-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 24px rgba(77, 54, 34, 0.18);
                border-color: #a1887f;
                background: rgba(77, 54, 34, 0.5);
            }

            .post-title, .post-category, .post-meta, .post-views {
                color: #f5f5dc;
            }

            .post-image {
                width: 100%;
                height: 200px;
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                position: relative;
                overflow: hidden;
            }

            .post-image::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                    radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.2) 0%, transparent 50%);
            }

            .post-content {
                padding: 24px;
            }

            .post-category {
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: #8b949e;
                margin-bottom: 12px;
            }

            .post-title {
                font-size: 18px;
                font-weight: 600;
                color: #f0f6fc;
                margin-bottom: 8px;
                line-height: 1.3;
            }

            .post-meta {
                display: flex;
                align-items: center;
                gap: 16px;
                margin-top: 16px;
                font-size: 14px;
                color: #8b949e;
            }

            .post-views {
                display: flex;
                align-items: center;
                gap: 4px;
            }

            /* Posts Grid */
            .posts-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
                gap: 32px;
                margin-top: 40px;
                padding: 0 20px;
                width: 100%;
                position: relative;
                z-index: 2;
            }

            /* Filters */
            .filters {
                background: rgba(77, 54, 34, 0.35); /* more transparent brown */
                border: 1.5px solid rgba(62, 39, 35, 0.5);
                border-radius: 12px;
                padding: 24px;
                margin-bottom: 40px;
                margin-top: 40px;
                width: 100%;
                backdrop-filter: blur(18px);
                position: relative;
                z-index: 2;
                color: #f5f5dc;
            }
            .filters h3, .filters label, .filters .btn, .filters .filter-select, .filters .selected-tags, .filters .tag-label {
                color: #f5f5dc !important;
            }

            .filters h3 {
                margin-bottom: 16px;
                color: #f0f6fc;
                font-size: 18px;
                font-weight: 600;
            }

            .filter-row {
                display: flex;
                gap: 24px;
                align-items: flex-end;
                flex-wrap: wrap;
            }

            .filter-group {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .filter-group label {
                font-size: 14px;
                font-weight: 500;
                color: #8b949e;
            }

            .filter-select {
                background-color: rgba(13, 17, 23, 0.8);
                color: #e6edf3;
                border: 1px solid rgba(48, 54, 61, 0.5);
                border-radius: 6px;
                padding: 12px;
                font-size: 14px;
                min-width: 150px;
                backdrop-filter: blur(10px);
            }

            .filter-select:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
            }

            /* Alert Styles */
            .alert {
                padding: 16px 20px;
                border-radius: 8px;
                margin-bottom: 24px;
                font-size: 14px;
                width: 100%;
                backdrop-filter: blur(10px);
                position: relative;
                z-index: 2;
            }

            .alert-info {
                background: rgba(12, 45, 107, 0.8);
                color: #58a6ff;
                border: 1px solid rgba(31, 111, 235, 0.5);
            }

            .alert a {
                color: #58a6ff;
                text-decoration: underline;
            }

            /* Pagination */
            .pagination {
                display: flex;
                justify-content: center;
                gap: 8px;
                margin-top: 40px;
                width: 100%;
                position: relative;
                z-index: 2;
            }

            .pagination a,
            .pagination span {
                padding: 12px 16px;
                border: 1px solid rgba(48, 54, 61, 0.5);
                border-radius: 6px;
                color: #8b949e;
                text-decoration: none;
                transition: all 0.2s ease;
                backdrop-filter: blur(10px);
                background: rgba(22, 27, 34, 0.8);
            }

            .pagination a:hover {
                background-color: rgba(33, 38, 45, 0.8);
                border-color: rgba(139, 148, 158, 0.8);
            }

            .pagination .current {
                background-color: #667eea;
                border-color: #667eea;
                color: #ffffff;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .header-container {
                    padding: 0 16px;
                }

                .nav-links {
                    display: none;
                }

                .featured-grid {
                    grid-template-columns: 1fr;
                }

                .featured-sidebar {
                    grid-template-columns: 1fr;
                }

                .posts-grid {
                    grid-template-columns: 1fr;
                    padding: 0 16px;
                }

                .featured-section {
                    padding: 40px 16px;
                }

                .section-title {
                    font-size: 24px;
                }

                .filters {
                    margin: 40px 16px;
                }

                .alert {
                    margin: 0 16px 24px 16px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <div class="header-container">
                <a href="{{ route('posts.index') }}" class="logo">
                    <div class="logo-icon">D</div>
                    DevBlog
                </a>
                <div class="nav-right">
                    <ul class="nav-links">
                        <li><a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Posts</a></li>
                        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
                        <li><a href="{{ route('tags.index') }}" class="{{ request()->routeIs('tags.*') ? 'active' : '' }}">Tags</a></li>
                    </ul>
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline">{{ Auth::user()->name }}</button>
                            <div class="dropdown-content">
                                <a href="{{ route('profile.edit') }}">Profile</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Log Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Subscribe</a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Category Navigation -->
        <nav class="category-nav">
            <div class="category-container">
                <ul class="category-list">
                    <li><a href="{{ route('posts.index') }}" class="{{ !request('category_id') ? 'active' : '' }}">ALL TOPICS</a></li>
                    @foreach(\App\Models\Category::all() as $category)
                        <li><a href="{{ route('posts.index', ['category_id' => $category->id]) }}" class="{{ request('category_id') == $category->id ? 'active' : '' }}">{{ strtoupper($category->name) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <!-- Main Content with Dark Background -->
        <main class="main-content">
            @yield('content')
        </main>
    </body>
</html>
