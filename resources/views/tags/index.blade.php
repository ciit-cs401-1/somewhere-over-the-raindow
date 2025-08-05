@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="max-w-5xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Tags</h1>
            @auth
            <a href="{{ route('tags.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create New Tag</a>
            @endauth
        </div>
        @if($tags->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Posts</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($tags as $tag)
                            <tr>
                                <td class="px-4 py-2 text-blue-700 dark:text-blue-300 hover:underline"><a href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a></td>
                                <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $tag->posts_count ?? $tag->posts->count() }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    @auth
                                    <a href="{{ route('tags.edit', $tag) }}" class="inline-block px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-xs">Edit</a>
                                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this tag?');">
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
        @else
            <p class="text-gray-500 dark:text-gray-400">No tags found.</p>
        @endif
        @if (Auth::guest())
            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded">
                To create, edit, or delete tags, <a href="{{ route('login') }}" class="underline">log in</a> or <a href="{{ route('register') }}" class="underline">register</a>.
            </div>
        @endif
    </div>
@endsection 