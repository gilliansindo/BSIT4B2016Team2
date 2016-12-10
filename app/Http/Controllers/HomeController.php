<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Post $posts)
    {
        $posts = Post::orderby('created_at','desc')->paginate(2);
        $comments = Comment::all();
        $title = 'Latest Posts';
        return view('home',compact(['posts','user','comments','title' ]));
    }

    public function addPost(Request $request, User $user)
    {
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->content = $request->content;
        // $request->file('file_upload')->store('file_upload');
        // $post->filepath = $request->file('file_upload')->getRealPath();
        $post->save();
        // return var_dump($request->file('file_upload')->getMimeType());
        // getClientOriginalName   getClientOriginalExtension  getRealPath  getMimeType  getSize
        return back();
    }

    public function addComment(Request $request, User $user, Comment $comment)
    {
        // $comment->comment = $request->comment;
        // $post->post_comment()->save($comment);
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        return back();
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return view('edit-post',compact('post'));
    }

    public function updatePost(Request $request)
    {
        $this->validate(request(),[
            'content' => 'required'
        ]);
        
        $post = Post::find($request->post_id);
        $post->update([
            'content' => $request->content
        ]);

        return back();

        // return var_dump($post);
    }
}
