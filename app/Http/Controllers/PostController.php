<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment; // Import the Comment model

class PostController extends Controller
{
    public function index()
    {
        // Fetch posts with pagination
        $posts = Post::paginate(3); // 3 posts per page

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

    public function show(Post $post)
    {
        // Fetch the comments for the post
        $comments = $post->comments()->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post)
    {
        // Return the edit view with the post data
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $data = $request->only('title', 'content');
        
        if ($request->hasFile('image')) {
            // If there's a new image, store it and update the image path
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        // Check if the authenticated user is an admin and is the same as the user who created the post
        if (auth()->user()->isAdmin() && auth()->id() === $post->user_id) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        }

        return redirect()->route('posts.index')->with('error', 'Unauthorized action.');
    }
}
