<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        // Create and save the comment
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Comment $comment)
    {
        // Ensure the authenticated user is the owner of the comment
        if (auth()->id() !== $comment->user_id) {
            return redirect()->route('posts.show', $comment->post_id)->withErrors('You are not authorized to delete this comment.');
        }

        // Delete the comment
        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id)->with('status', 'Comment deleted successfully!');
    }


}
