<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postsmodel as Post;
use App\Models\Commentsmodel;

class Postscontroller extends Controller
{
    public function create_post(Request $request)
    {
        // validate the request
        $request->validate([
           
            'body' => 'required'
        ]);
        // create a post
        $post = new Post;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->save();
        return back()->with('status', 'Post created successfully');
    }
    public function fetch_posts(Request $request)
    {
        $perPage = $request->input('page',3); // Number of posts per page
        $posts = Post::paginate($perPage);

        return response()->json($posts);
    
    }
    public function create_comment(Request $request)
    {
        // validate the request
        $request->validate([
            'post_id' => 'required',
            'comment' => 'required'
        ]);
        // create a comment
        $comment = new Commentsmodel;
        $comment->body = $request->comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();
        return back()->with('status', 'Comment created successfully');
    }
    public function delete_post($id)
    {
        
        // delete a post
        $post = Post::find($id);
        if($post)
        {
            if($post->user_id != auth()->user()->id){
                return back()->with('status', 'You are not authorized to delete this post');
            }
            else{
                $post->delete();
            }
        }
        else{
            return back()->with('status', 'Post not found');
        }
        
        return back()->with('status', 'Post deleted successfully');
    }
    public function delete_comment($id)
    {
        $comment = Commentsmodel::find($id);
        if($comment)
        {
            if($comment->user_id != auth()->user()->id){
                return back()->with('status', 'You are not authorized to delete this comment');
            }
            else{
                $comment->delete();
            }
        }
        else{
            return back()->with('status', 'Comment not found');
        }
        
        return back()->with('status', 'Comment deleted successfully');
    }
}
