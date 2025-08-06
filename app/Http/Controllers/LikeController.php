<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        if ($post->likes()->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already liked this post.');
        }

        $post->likes()->create(['user_id' => Auth::id()]);

        return back()->with('success', 'Post liked!');
    }

    public function destroy(Request $request, Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            return back()->with('success', 'Post unliked!');
        }

        return back()->with('error', 'You have not liked this post.');
    }
}
