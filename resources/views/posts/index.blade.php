@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="max-w-5xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Posts</h1>
            @auth
            <a href="{{ route('posts.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create New Post</a>
            @endauth
        </div>

        @if($posts->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Excerpt</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Category</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tags</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($posts as $post)
                            <tr>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $post->title }}</td>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $post->excerpt }}</td>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $post->category->name ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    @foreach($post->tags as $tag)
                                        <span class="inline-block bg-purple-200 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded px-2 py-0.5 text-xs font-semibold mr-1 mb-1">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ ucfirst($post->status) }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('posts.show', $post) }}" class="inline-block px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 text-xs">View</a>
                                    @auth
                                    <a href="{{ route('posts.edit', $post) }}" class="inline-block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">Edit</a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">Delete</button>
                                    </form>
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">No posts found.</p>
        @endif
        @if (Auth::guest())
            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded">
                To create, edit, or delete posts, <a href="{{ route('login') }}" class="underline">log in</a> or <a href="{{ route('register') }}" class="underline">register</a>.
            </div>
        @endif
    </div>
@endsection 