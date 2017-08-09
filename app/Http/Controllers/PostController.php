<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;

class PostController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $post
     * @return \Illuminate\Http\Response
     */
    public function store($board)
    {
        $validator = $this->validateStore([
            'title' => 'required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->respondBadRequest();
        }

        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'board_name' => $board,
            'user_id' => $this->getAuthenticatedUser()->id
        ]);
        return $this->respondCreated();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($board, $post)
    {
        // dd(request());
        $post = Post::find($post);
        if (!$post) {
            return $this->respondNotFound();
        }
        $comments = $post->comments()->orderBy('created_at', 'dec')->get();
        // $comments = Comment::find()
        return $this->respondOkWithData([
            'post' => $post,
            'author' => User::find($post->user_id),
            'comments' => $comments
        ]);
    }
}
