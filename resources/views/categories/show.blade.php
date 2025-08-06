@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>
    <h3 class="mt-4">Posts in this Category</h3>
    @if($category->posts->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->excerpt }}</td>
                        <td>
                            @foreach($post->tags as $tag)
                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ ucfirst($post->status) }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No posts in this category.</p>
    @endif
@endsection