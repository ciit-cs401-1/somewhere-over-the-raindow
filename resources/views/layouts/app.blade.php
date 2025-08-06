<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>



        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap" rel="stylesheet">

        <!-- SwiperJS CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Modern Blog Design CSS -->
        <style>
            /* --- Base and Variables --- */
            :root {
                --primary-dark: #2c3e50;  /* Deep blue-gray */
                --primary: #34495e;       /* Medium blue-gray */
                --primary-light: #7f8c8d; /* Light blue-gray */
                --accent: #3498db;        /* Bright blue */
                --accent-light: #85c1e9;  /* Light blue */
                --brown-dark: #3e2723;     /* Dark Brown */
                --brown-light: #4d3622;    /* Lighter Brown */
                --text-light: #f5f5dc;     /* Beige/Off-white */
                --text-accent: #ffe082;    /* Light Yellow */
                --white: #ffffff;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Merienda', cursive;
                background-color: #ffffff;
                color: #1a1a1a;
                line-height: 1.6;
                font-size: 16px;
                min-height: 100vh;
            }

            /* --- Layout: Header, Nav, Main --- */
            .header {
                background: rgba(77, 54, 34, 0.97); /* warm brown */
                border-bottom: 1px solid var(--brown-dark);
                padding: 20px 0;
                position: sticky;
                top: 0;
                z-index: 100;
                color: var(--text-light);
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

            .category-nav {
                background: rgba(77, 54, 34, 0.95);
                border-bottom: 1px solid var(--brown-dark);
                padding: 16px 0;
                overflow-x: auto;
            }

            .main-content {
                background: 
                    linear-gradient(rgba(20, 20, 20, 0.7), rgba(20, 20, 20, 0.7)),
                    url('/blog-wallpaper.jpg') center center / cover no-repeat;
                min-height: calc(100vh - 140px);
                color: var(--text-light);
                padding: 2rem;
            }

            /* --- Components --- */

            /* Logo */
            .logo {
                display: flex;
                align-items: center;
                gap: 12px;
                text-decoration: none;
                transition: transform 0.2s ease-in-out;
            }
            .logo:hover { transform: scale(1.03); }
            .logo-text { font-family: 'Merienda', cursive; font-size: 28px; font-weight: 700; color: var(--text-light); }
            .logo-icon { width: 45px; height: 45px; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-family: 'Merienda', cursive; font-weight: 700; font-size: 18px; }

            /* Navigation */
            .nav-right { display: flex; align-items: center; gap: 24px; }
            .nav-links { display: flex; gap: 32px; list-style: none; }
            .nav-links a { color: var(--text-light); text-decoration: none; font-weight: 500; font-size: 14px; transition: color 0.2s ease; }
            .nav-links a.active, .nav-links a:hover { color: var(--text-accent); }

            /* Category Tabs */
            .category-list { display: flex; gap: 32px; list-style: none; white-space: nowrap; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
            .category-list a { color: var(--text-light); text-decoration: none; font-weight: 500; font-size: 14px; transition: all 0.2s ease; padding: 8px 0; border-bottom: 2px solid transparent; }
            .category-list a.active, .category-list a:hover { color: var(--text-accent); border-bottom-color: var(--text-accent); }

            /* Search */
            .search-icon { width: 24px; height: 24px; color: var(--text-light); cursor: pointer; transition: color 0.3s ease; }
            .search-icon:hover { color: var(--text-accent); }
            .search-form { position: relative; transition: all 0.3s ease; }
            .search-form.hidden { width: 0; opacity: 0; overflow: hidden; }
            .search-input { border: 1.5px solid var(--primary-light); border-radius: 20px; padding: 8px 16px; background: rgba(255, 255, 255, 0.1); color: var(--text-light); width: 200px; transition: all 0.3s ease; }
            .search-input::placeholder { color: var(--primary-light); }
            .search-input:focus { outline: none; border-color: var(--text-accent); background: rgba(255, 255, 255, 0.2); }

            /* Buttons & Dropdown */
            .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.2s ease; border: 2px solid var(--text-light); cursor: pointer; display: inline-block; }
            .btn-outline { color: var(--text-light); background: transparent; }
            .btn-outline:hover { background-color: var(--text-light); color: var(--brown-dark); }
            .btn-primary { background-color: var(--text-light); color: var(--brown-dark); border-color: var(--text-light); }
            .btn-primary:hover { background-color: var(--text-accent); border-color: var(--text-accent); }
            .dropdown { position: relative; display: inline-block; }
            .dropdown-content { display: none; position: absolute; right: 0; background-color: var(--brown-dark); min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 6px; overflow: hidden; }
            .dropdown:hover .dropdown-content { display: block; }
            .dropdown-content a, .dropdown-content button { color: var(--text-light); padding: 12px 16px; text-decoration: none; display: block; text-align: left; background: none; border: none; width: 100%; cursor: pointer; }
            .dropdown-content a:hover, .dropdown-content button:hover { background-color: var(--brown-light); }
            .dropdown-divider { height: 1px; margin: 4px 0; background-color: var(--brown-light); }

            /* Section Header */
            .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 1px solid rgba(245,245,220,0.15); }
            .section-title { font-size: 28px; font-weight: 700; color: var(--text-light); }
            .view-all { font-size: 14px; color: var(--text-accent); text-decoration: none; font-weight: 500; }

            /* Posts Grid & Cards */
            .posts-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px; }
            .post-card { background: rgba(77, 54, 34, 0.35); border: 1.5px solid rgba(62, 39, 35, 0.5); border-radius: 12px; overflow: hidden; transition: all 0.3s ease; backdrop-filter: blur(18px); display: flex; flex-direction: column; }
            .post-card:hover { transform: translateY(-8px); box-shadow: 0 12px 24px rgba(0,0,0,0.25); border-color: rgba(255,224,130,0.6); }
            .post-image-link { display: block; }
            .post-image { width: 100%; height: 200px; object-fit: cover; transition: transform 0.4s ease; }
            .post-card:hover .post-image { transform: scale(1.08); }
            .post-content { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
            .post-category { font-weight: 500; font-size: 12px; color: var(--text-accent); background: rgba(255,224,130,0.1); padding: 4px 12px; border-radius: 16px; display: inline-block; margin-bottom: 12px; }
            .post-title { font-size: 20px; font-weight: 600; margin-bottom: 12px; line-height: 1.4; }
            .post-title a { color: var(--text-light); text-decoration: none; }
            .card-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid rgba(245,245,220,0.1); }
            .post-tags { display: flex; gap: 8px; flex-wrap: wrap; }
            .tag-label { font-size: 12px; padding: 4px 10px; border-radius: 14px; background: rgba(245,245,220,0.1); color: var(--text-accent); }

            /* Pagination */
            .pagination { margin-top: 40px; display: flex; justify-content: center; }
            .pagination a, .pagination span { color: var(--text-light); padding: 10px 16px; margin: 0 4px; border: 1px solid rgba(245,245,220,0.2); border-radius: 6px; text-decoration: none; transition: all 0.2s ease; }
            .pagination a:hover, .pagination .current { background: var(--text-accent); color: var(--brown-dark); border-color: var(--text-accent); }

            /* Hero Slider */
            .hero-slider-container { width: 100%; height: 500px; margin-bottom: 3rem; }
            .hero-swiper { width: 100%; height: 100%; }
            .swiper-slide { position: relative; overflow: hidden; border-radius: 15px; }
            .slide-background { width: 100%; height: 100%; background-size: cover; background-position: center; transition: transform 0.4s ease-in-out; }
            .swiper-slide-active .slide-background { transform: scale(1.05); }
            .slide-content { position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; padding: 2rem 4rem; background: linear-gradient(90deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0) 100%); }
            .info-box { background: rgba(77, 54, 34, 0.6); backdrop-filter: blur(10px); padding: 2rem; border-radius: 15px; max-width: 450px; border: 1px solid rgba(245,245,220,0.2); box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
            .slide-title { font-size: 2rem; font-weight: 700; color: var(--text-light); margin: 1rem 0; }
            .slide-excerpt { font-size: 1rem; color: var(--text-light); margin-bottom: 1.5rem; }
            .swiper-button-next, .swiper-button-prev { color: var(--white); }
            .swiper-pagination-bullet-active { background: var(--white); }

            /* Category-specific Colors */
            .category-technology { background: #27ae60; color: white; }
            .category-business { background: #8e44ad; color: white; }
            .category-travel { background: #3498db; color: white; }
            .category-food { background: #e67e22; color: white; }
            .category-lifestyle { background: #e74c3c; color: white; }

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


                .alert {
                    margin: 0 16px 24px 16px;
                }
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <div class="header-container">
                <a href="{{ route('posts.index') }}" class="logo">
                    <div class="logo-icon">CX</div>
                    <span class="logo-text">CoxBlog</span>
                </a>
                <div class="nav-right">
                    <ul class="nav-links">
                        <li><a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Posts</a></li>
                        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
                        <li><a href="{{ route('tags.index') }}" class="{{ request()->routeIs('tags.*') ? 'active' : '' }}">Tags</a></li>
                    </ul>
                    <form action="{{ route('posts.search') }}" method="GET" class="search-form hidden">
                        <input type="text" name="search" placeholder="Search..." class="search-input" value="{{ request('search') }}">
                    </form>
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
        @stack('scripts')
        </main>

    <!-- SwiperJS JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchIcon = document.querySelector('.search-icon');
            const searchForm = document.querySelector('.search-form');

            searchIcon.addEventListener('click', function (e) {
                e.stopPropagation();
                searchForm.classList.toggle('hidden');
                if (!searchForm.classList.contains('hidden')) {
                    searchForm.querySelector('.search-input').focus();
                }
            });

            document.addEventListener('click', function (e) {
                if (!searchForm.contains(e.target) && !searchIcon.contains(e.target)) {
                    searchForm.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
