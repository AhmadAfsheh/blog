<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Import the Post model

class PostController extends Controller
{

    
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $data = $request->only('title', 'content');
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        auth()->user()->posts()->create($data);

        return redirect()->route('posts.index');
    }
}
