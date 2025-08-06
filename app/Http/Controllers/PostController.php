<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user', 'tags', 'likes'])
            ->published();



        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by tags
        if ($request->filled('tags')) {
            $tagIds = $request->tags;
            $query->whereHas('tags', function ($q) use ($tagIds) {
                $q->whereIn('tags.id', $tagIds);
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        
        $categories = Category::all();
        $tags = Tag::all();
            
        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Display search results.
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $searchTerm = $request->search;

        $query = Post::with(['category', 'user', 'tags'])
            ->published()
            ->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });

        $posts = $query->latest()->paginate(10)->withQueryString();

        return view('posts.search', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($validated['title']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('featured_images', 'public');
            $data['featured_image'] = $path;
        }

        $post = Post::create($data);

        if (isset($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['category', 'user', 'tags', 'likes']);
        $post->increment('views');
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $path = $request->file('featured_image')->store('featured_images', 'public');
            $data['featured_image'] = $path;
        }

        $post->update($data);

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}
