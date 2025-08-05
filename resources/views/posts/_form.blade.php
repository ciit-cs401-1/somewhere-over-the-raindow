<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control @error('title') error @enderror" value="{{ old('title', $post->title ?? '') }}">
    @error('title')<div class="error-message">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" id="content" rows="8" class="form-control @error('content') error @enderror">{{ old('content', $post->content ?? '') }}</textarea>
    @error('content')<div class="error-message">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="featured_image">Featured Image</label>
    <input type="file" name="featured_image" id="featured_image" class="form-control @error('featured_image') error @enderror">
    @if(isset($post) && $post->featured_image)
        <div style="margin-top: 8px;">
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" style="max-height: 100px; border-radius: 4px;">
        </div>
    @endif
    @error('featured_image')<div class="error-message">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control @error('category_id') error @enderror">
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')<div class="error-message">{{ $message }}</div>@enderror
</div>

<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" id="tags" multiple class="form-control @error('tags') error @enderror">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ (collect(old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []))->contains($tag->id)) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    @error('tags')<div class="error-message">{{ $message }}</div>@enderror
</div>