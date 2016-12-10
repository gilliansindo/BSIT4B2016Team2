<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post_comment()
    {
    	return $this->belongsTo('App\Post');
    }

    public function user_comment()
    {
    	return $this->belongsTo('App\User');
    }
}
