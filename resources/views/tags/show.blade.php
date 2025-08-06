@extends('layouts.app')

@section('title', $tag->name)

@section('content')
    <div class="mb-3">
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to Tags</a>
        <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this tag?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
    <h1>{{ $tag->name }}</h1>
    <h3 class="mt-4">Posts with this Tag</h3>
    @if($tag->posts->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tag->posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->excerpt }}</td>
                        <td>{{ $post->category->name ?? '-' }}</td>
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
        <p>No posts with this tag.</p>
    @endif
@endsection