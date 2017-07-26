<?php

namespace App;

class Board extends ApiModel
{
	protected $primaryKey = 'name';
    protected $guarded = [];
    public $incrementing = false;
    protected $hidden = ['created_at', 'updated_at'];
	
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function admin()
    {
    	return $this->belongsTo(User::class);
    }
}
