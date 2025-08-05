@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Create Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('posts._form')
            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create</button>
                <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 transition">Cancel</a>
            </div>
        </form>
    </div>
@endsection