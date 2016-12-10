<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function newPost()
    {
    	return view('blog.new');
    }

    public function createPost()
    {
    	
    }

    public function viewPost($id)
    {
    	$post = Post::findOrFail($id);

    	return view('blog.view',array(
    		'post' => $post
    	));
    }
}
