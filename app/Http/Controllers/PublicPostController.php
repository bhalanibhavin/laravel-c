<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PublicPostController extends Controller
{
    public function publicIndex()
    {
        $posts = Post::where('status', 1)->latest()->paginate(9);
        return view('posts.index', compact('posts'));
    }

    public function showPublic(string $slug)
    {
        $post = Post::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
