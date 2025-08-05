@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <div class="flex flex-wrap gap-2 mb-6 items-center">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">Back to Posts</a>
            <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this post?');">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
            </form>
        </div>
        <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-100">{{ $post->title }}</h1>
        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="w-full max-h-96 object-cover rounded mb-6 shadow">
        @endif
        <div class="mb-2 text-gray-700 dark:text-gray-300">
            <span class="font-semibold">Category:</span> {{ $post->category->name ?? '-' }}
        </div>
        <div class="mb-2 text-gray-700 dark:text-gray-300">
            <span class="font-semibold">Tags:</span>
            @foreach($post->tags as $tag)
                <span class="inline-block bg-purple-200 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded px-2 py-0.5 text-xs font-semibold mr-1 mb-1">{{ $tag->name }}</span>
            @endforeach
        </div>
        {{-- <div class="mb-4 text-gray-700 dark:text-gray-300">
            <span class="font-semibold">Excerpt:</span>
            <p class="mt-1">{{ $post->excerpt }}</p>
        </div> --}}
        <div class="text-gray-700 dark:text-gray-300">
            <span class="font-semibold">Content:</span>
            <div class="mt-1 whitespace-pre-line">{!! nl2br(e($post->content)) !!}</div>
        </div>
    </div>
@endsection