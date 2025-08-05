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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Fallback CSS in case Vite doesn't load -->
        <style>
            /* Dark Theme */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Noto Sans', Helvetica, Arial, sans-serif;
                background-color: #0d1117;
                color: #e6edf3;
                line-height: 1.6;
            }

            /* Navigation */
            .navbar {
                background-color: #161b22;
                border-bottom: 1px solid #30363d;
                padding: 16px 0;
                position: sticky;
                top: 0;
                z-index: 100;
            }

            .nav-container {
                max-width: 1280px;
                margin: 0 auto;
                padding: 0 32px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .nav-left {
                display: flex;
                align-items: center;
                gap: 32px;
            }

            .logo {
                font-size: 24px;
                font-weight: 700;
                color: #f0f6fc;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .nav-links {
                display: flex;
                gap: 24px;
                list-style: none;
            }

            .nav-links a {
                color: #e6edf3;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s ease;
                padding: 8px 12px;
                border-radius: 6px;
            }

            .nav-links a:hover {
                color: #f0f6fc;
                background-color: #21262d;
            }

            .nav-links a.active {
                color: #f0f6fc;
                background-color: #21262d;
            }

            .nav-right {
                display: flex;
                gap: 12px;
            }

            /* Dropdown Styles */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                background-color: #161b22;
                min-width: 160px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
                border: 1px solid #30363d;
                border-radius: 8px;
                z-index: 1000;
                margin-top: 4px;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .dropdown-content a {
                color: #e6edf3;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                transition: background-color 0.2s ease;
            }

            .dropdown-content a:hover {
                background-color: #21262d;
            }

            .dropdown-content form {
                margin: 0;
            }

            .dropdown-content button {
                width: 100%;
                text-align: left;
                background: none;
                border: none;
                color: #e6edf3;
                padding: 12px 16px;
                cursor: pointer;
                font-size: 14px;
                transition: background-color 0.2s ease;
            }

            .dropdown-content button:hover {
                background-color: #21262d;
            }

            .dropdown-divider {
                height: 1px;
                background-color: #30363d;
                margin: 4px 0;
            }

            .btn {
                padding: 8px 16px;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.2s ease;
                border: 1px solid transparent;
                cursor: pointer;
                font-size: 14px;
                display: inline-block;
            }

            .btn-outline {
                color: #e6edf3;
                border-color: #30363d;
            }

            .btn-outline:hover {
                background-color: #21262d;
                border-color: #8b949e;
            }

            .btn-primary {
                background-color: #238636;
                color: #fff;
                border-color: #238636;
            }

            .btn-primary:hover {
                background-color: #2ea043;
                border-color: #2ea043;
            }

            .btn-warning {
                background-color: #d29922;
                color: #fff;
                border-color: #d29922;
            }

            .btn-warning:hover {
                background-color: #e3a341;
                border-color: #e3a341;
            }

            .btn-danger {
                background-color: #da3633;
                color: #fff;
                border-color: #da3633;
            }

            .btn-danger:hover {
                background-color: #f85149;
                border-color: #f85149;
            }

            .btn-info {
                background-color: #1f6feb;
                color: #fff;
                border-color: #1f6feb;
            }

            .btn-info:hover {
                background-color: #388bfd;
                border-color: #388bfd;
            }

            /* Main Container */
            .container {
                max-width: 1280px;
                margin: 0 auto;
                padding: 32px;
                background-color: #0d1117;
                color: #e6edf3;
            }

            /* Filters */
            .filters {
                background-color: #161b22;
                border: 1px solid #30363d;
                border-radius: 12px;
                padding: 24px;
                margin-bottom: 32px;
            }

            .filters h3 {
                margin-bottom: 16px;
                color: #f0f6fc;
                font-size: 16px;
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

            .filter-buttons {
                display: flex;
                gap: 12px;
                align-items: flex-end;
            }

            .filter-group label {
                font-size: 14px;
                font-weight: 500;
                color: #8b949e;
            }

            .filter-select {
                background-color: #0d1117;
                color: #e6edf3;
                border: 1px solid #30363d;
                border-radius: 6px;
                padding: 8px 12px;
                font-size: 14px;
                min-width: 150px;
            }

            .filter-select:focus {
                outline: none;
                border-color: #1f6feb;
                box-shadow: 0 0 0 2px rgba(31, 111, 235, 0.3);
            }

            .filter-select option {
                background-color: #0d1117;
                color: #e6edf3;
            }

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
                padding: 8px 12px;
                font-size: 14px;
                min-width: 150px;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                transition: all 0.2s ease;
            }

            .multi-select-display:hover {
                border-color: #8b949e;
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
                accent-color: #1f6feb;
            }

            .tag-label {
                color: #e6edf3;
                font-size: 14px;
            }

            .selected-tags {
                color: #e6edf3;
            }

            .clear-filters {
                background: none;
                border: 1px solid #30363d;
                color: #e6edf3;
                padding: 8px 16px;
                border-radius: 6px;
                cursor: pointer;
                font-size: 14px;
                transition: all 0.2s ease;
            }

            .clear-filters:hover {
                background-color: #21262d;
                border-color: #8b949e;
            }

            /* Posts Grid */
            .posts-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
            }

            .posts-header h2 {
                color: #f0f6fc;
                font-size: 24px;
                font-weight: 600;
            }

            .posts-count {
                color: #8b949e;
                font-size: 14px;
            }

            .posts-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
                gap: 24px;
            }

            /* Post Card */
            .post-card {
                background-color: #161b22;
                border: 1px solid #30363d;
                border-radius: 12px;
                padding: 24px;
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .post-card:hover {
                border-color: #8b949e;
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            }

            .post-title {
                font-size: 20px;
                font-weight: 600;
                color: #f0f6fc;
                margin-bottom: 12px;
                line-height: 1.3;
                text-decoration: none;
            }

            .post-title:hover {
                color: #58a6ff;
            }

            .post-meta {
                display: flex;
                align-items: center;
                gap: 16px;
                margin-bottom: 16px;
                flex-wrap: wrap;
            }

            .post-category {
                background-color: #1f6feb;
                color: #fff;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
                text-decoration: none;
            }

            .post-views {
                color: #8b949e;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .post-views::before {
                content: "👁";
            }

            .post-tags {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .tag {
                background-color: #21262d;
                color: #e6edf3;
                padding: 2px 8px;
                border-radius: 12px;
                font-size: 12px;
                text-decoration: none;
                border: 1px solid #30363d;
                transition: all 0.2s ease;
            }

            .tag:hover {
                background-color: #30363d;
                border-color: #8b949e;
            }

            /* Form Styles */
            .form-container {
                background-color: #161b22;
                border: 1px solid #30363d;
                border-radius: 12px;
                padding: 24px;
                max-width: 600px;
                margin: 0 auto;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: #8b949e;
                font-size: 14px;
            }

            .form-control {
                width: 100%;
                background-color: #0d1117;
                color: #e6edf3;
                border: 1px solid #30363d;
                border-radius: 6px;
                padding: 12px;
                font-size: 14px;
                transition: all 0.2s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #1f6feb;
                box-shadow: 0 0 0 2px rgba(31, 111, 235, 0.3);
            }

            .form-control.error {
                border-color: #da3633;
            }

            .form-control option {
                background-color: #0d1117;
                color: #e6edf3;
            }

            .error-message {
                color: #da3633;
                font-size: 12px;
                margin-top: 4px;
            }

            /* Alert Styles */
            .alert {
                padding: 12px 16px;
                border-radius: 6px;
                margin-bottom: 16px;
                font-size: 14px;
            }

            .alert-info {
                background-color: #0c2d6b;
                color: #58a6ff;
                border: 1px solid #1f6feb;
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
                margin-top: 24px;
            }

            .pagination a,
            .pagination span {
                padding: 8px 12px;
                border: 1px solid #30363d;
                border-radius: 6px;
                color: #e6edf3;
                text-decoration: none;
                transition: all 0.2s ease;
            }

            .pagination a:hover {
                background-color: #21262d;
                border-color: #8b949e;
            }

            .pagination .current {
                background-color: #1f6feb;
                border-color: #1f6feb;
                color: #fff;
            }

            /* Override any default browser styles */
            select, input, textarea {
                background-color: #0d1117 !important;
                color: #e6edf3 !important;
                border-color: #30363d !important;
            }

            select option {
                background-color: #0d1117 !important;
                color: #e6edf3 !important;
            }

            /* Ensure all text is properly colored */
            p, h1, h2, h3, h4, h5, h6, span, div {
                color: #e6edf3;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .nav-container {
                    padding: 0 16px;
                }

                .nav-left {
                    gap: 16px;
                }

                .nav-links {
                    gap: 12px;
                }

                .nav-links a {
                    padding: 6px 8px;
                    font-size: 14px;
                }

                .container {
                    padding: 16px;
                }

                .filters {
                    padding: 16px;
                }

                .filter-row {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 16px;
                }

                .posts-grid {
                    grid-template-columns: 1fr;
                }

                .post-meta {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }
            }

            @media (max-width: 480px) {
                .nav-links {
                    display: none;
                }

                .logo {
                    font-size: 20px;
                }

                .post-card {
                    padding: 16px;
                }

                .post-title {
                    font-size: 18px;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-left">
                    <a href="{{ route('posts.index') }}" class="logo">DevBlog</a>
                    <ul class="nav-links">
                        <li><a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Posts</a></li>
                        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
                        <li><a href="{{ route('tags.index') }}" class="{{ request()->routeIs('tags.*') ? 'active' : '' }}">Tags</a></li>
                    </ul>
                </div>
                <div class="nav-right">
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
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="container">
            @yield('content')
        </main>
    </body>
</html>
