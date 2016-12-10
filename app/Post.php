<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comment_post()
    {
    	return $this->hasMany('App\Comment');
    }

    public function getNumCommentsStr()
    {
    	$num = $this->comment_post()->count();

    	if($num == 1){
    		return '1 comment';
    	}
        elseif($num == 0){
            return;
        }

    	return $num . ' comments';
    }
}
