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

<<<<<<< HEAD
=======

>>>>>>> 215197e2fec78c1a42db863ebb907d3d6b3ea460
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
<<<<<<< HEAD

    public function show(Post $post)
    {
        // Fetch the comments for the post
        $comments = $post->comments()->latest()->get();

        return view('posts.show', compact('post', 'comments'));
    }
=======
>>>>>>> 215197e2fec78c1a42db863ebb907d3d6b3ea460
}
