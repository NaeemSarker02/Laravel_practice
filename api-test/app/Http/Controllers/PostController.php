<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // ✅ Create post
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }

    // ✅ Get all posts
    public function index()
    {
        $posts = Post::all(); // fetch all rows

        return response()->json([
            'status' => true,
            'message' => 'All posts fetched successfully',
            'data' => $posts
        ]);
    }
}
