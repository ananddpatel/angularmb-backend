<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends ApiModel
{
	protected $guarded = [];
	protected $hidden = ['updated_at'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }
}
