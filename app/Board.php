<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends ApiModel
{
	protected $primaryKey = 'name';
    protected $guarded = [];
    public $incrementing = false;
	
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function admin()
    {
    	return $this->belongsTo(User::class);
    }
}
