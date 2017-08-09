<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends ApiModel
{
	protected $guarded = [];
	protected $hidden = ['updated_at'];
    protected $appends = ['author'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function getAuthorAttribute()
    {
        return $this->user()->first();
    }
}
