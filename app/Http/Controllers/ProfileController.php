<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;

class ProfileController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index($id)
    {
    	$data['user'] = User::find($id);
    	$data['posts_count'] = $data['user']->post->count();
    	$data['posts'] = Post::orderby('created_at','desc')->where('user_id',$data['user']->id)->paginate(2);
    	$data['comments_count'] = $data['user']->comment_user->count();
    	return view('profile',$data);
    }
}
