<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Validator;

class CommentController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $post
     * @return \Illuminate\Http\Response
     */
    public function store($post)
    {
        $validator = $this->validateStore(['body' => 'required']);
        // true if already exists
        if ($validator->fails()) {return $this->respondBadRequest();}

        Comment::create([
            'body' => request('body'),
            'post_id' => $post,
            'user_id' => $this->getAuthenticatedUser()->id
        ]);
        return $this->respondCreated();
    }
}
