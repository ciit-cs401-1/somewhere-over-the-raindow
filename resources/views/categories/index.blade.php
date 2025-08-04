@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <h2>Categories</h2>
    
    @if($categories->count() > 0)
        @foreach($categories as $category)
            <div class="post-card">
                <h3>
                    <a href="{{ route('categories.show', $category) }}" class="post-title">
                        {{ $category->name }}
                    </a>
                </h3>
                
                <div class="post-meta">
                    <strong>Posts:</strong> {{ $category->posts_count }}
                </div>
                
                @if($category->description)
                    <p>{{ $category->description }}</p>
                @endif
            </div>
        @endforeach
        
        <div style="margin-top: 30px;">
            {{ $categories->links() }}
        </div>
    @else
        <p>No categories found.</p>
    @endif
    
    <div style="margin-top: 30px;">
        <a href="{{ route('categories.create') }}" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
            Create New Category
        </a>
    </div>
@endsection 