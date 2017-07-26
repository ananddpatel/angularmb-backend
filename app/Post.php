<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends ApiModel
{
	protected $guarded = [];
	
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    public function board()
    {
    	return $this->belongsTo(Board::class);
    }
}
