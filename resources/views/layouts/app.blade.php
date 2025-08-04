<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Blog')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        .nav {
            margin-bottom: 20px;
            padding: 10px 0;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #007bff;
            padding: 5px 10px;
        }
        .nav a:hover {
            background: #007bff;
            color: white;
            border-radius: 4px;
        }
        .post-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .post-title {
            color: #333;
            text-decoration: none;
            font-size: 1.2em;
            font-weight: bold;
        }
        .post-meta {
            color: #666;
            font-size: 0.9em;
            margin: 10px 0;
        }
        .tag {
            background: #007bff;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            margin-right: 5px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laravel Blog</h1>
            <p>A dynamic blog with categories and tags</p>
        </div>

        <div class="nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('posts.index') }}">Posts</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('tags.index') }}">Tags</a>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html> 