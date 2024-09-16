<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment; // Import the Comment model

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Fetch posts with search functionality
        $posts = Post::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(3); // Adjust pagination as needed

        return view('posts.index', compact('posts', 'search'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:8',
            'content' => 'required|min:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('title', 'content');

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $data['image'] = $imagePath;
            }

            auth()->user()->posts()->create($data);

            return redirect()->route('posts.index')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create post. Please try again.');
        }
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
        // Validate request data
        $request->validate([
            'title' => 'required|string|min:8|max:255',
            'content' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);
    
        // Prepare data for update
        $data = $request->only('title', 'content');
        
        try {
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($post->image && \Storage::disk('public')->exists($post->image)) {
                    \Storage::disk('public')->delete($post->image);
                }
                
                // Store new image and update the image path
                $imagePath = $request->file('image')->store('images', 'public');
                $data['image'] = $imagePath;
            }
    
            // Update the post
            $post->update($data);
    
            // Redirect with success message
            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Post update failed: ' . $e->getMessage());
    
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to update post. Please try again.');
        }
    }
    

    public function destroy(Post $post)
    {

        if (auth()->user()->isAdmin() ) {
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
        }
    
        return redirect()->route('posts.index')->with('error', 'Unauthorized action.');
    }
}
