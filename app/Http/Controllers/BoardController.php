<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;
use Validator;

class BoardController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $board
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // true if already exists
        if (!$this->validateStore(new Board())->fails()) {
            return $this->respondBadRequest();
        }

        Board::create(['name' => request('name')]);
        return $this->respondCreated();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show($board)
    {
        $board = Board::find($board);
        if ($board) {
            return $this->respondOkWithData(['board' => $board, 'posts' => []]);
        } 
        return $this->respondNotFound();
    }
}
