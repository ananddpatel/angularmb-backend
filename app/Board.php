<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function admin()
    {
    	return $this->belongsTo(User::class);
    }
}
