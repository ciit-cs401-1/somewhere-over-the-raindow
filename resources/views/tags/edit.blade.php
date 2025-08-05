@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <div class="max-w-xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <a href="{{ route('tags.index') }}" class="inline-block mb-4 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">Back to Tags</a>
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Edit Tag</h1>
        <form action="{{ route('tags.update', $tag) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Tag Name</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 @error('name') border-red-500 dark:border-red-500 @enderror" value="{{ old('name', $tag->name) }}" required>
                @error('name')
                    <div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update Tag</button>
        </form>
    </div>
@endsection