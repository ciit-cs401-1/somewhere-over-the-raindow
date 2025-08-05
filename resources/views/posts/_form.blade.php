<div class="mb-6">
    <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
    <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 @error('title') border-red-500 dark:border-red-500 @enderror" value="{{ old('title', $post->title ?? '') }}">
    @error('title')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
</div>
<div class="mb-6">
    <label for="content" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
    <textarea name="content" id="content" rows="6" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 @error('content') border-red-500 dark:border-red-500 @enderror">{{ old('content', $post->content ?? '') }}</textarea>
    @error('content')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
</div>
<div class="mb-6">
    <label for="featured_image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Featured Image</label>
    <input type="file" name="featured_image" id="featured_image" class="block w-full text-sm text-gray-700 dark:text-gray-200 border rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:border-gray-700 @error('featured_image') border-red-500 dark:border-red-500 @enderror">
    @if(isset($post) && $post->featured_image)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="max-h-24 rounded shadow">
        </div>
    @endif
    @error('featured_image')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
</div>
<div class="mb-6">
    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Category</label>
    <select name="category_id" id="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 @error('category_id') border-red-500 dark:border-red-500 @enderror">
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
</div>
<div class="mb-6">
    <label for="tags" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
    <select name="tags[]" id="tags" multiple class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 @error('tags') border-red-500 dark:border-red-500 @enderror">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ (collect(old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []))->contains($tag->id)) ? 'selected' : '' }}>{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tags')<div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>@enderror
</div>