<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'user', 'tags'])
            ->published()
            ->latest()
            ->paginate(10);
            
        return view('posts.index', compact('posts'));
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
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
            'user_id' => Auth::id()
        ]);

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
        $post->load(['category', 'user', 'tags']);
        
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status']
        ]);

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
        $post->delete();
        
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}
