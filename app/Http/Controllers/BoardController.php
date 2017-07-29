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
        $board = new Board();
        $exists = $this->validateStore([
            'name' => 'exists:' . $board->getTable() . ',' . $board->getPrimaryKey()
        ]);
        $given = $this->validateStore(['name' => 'required']);
        // true if already exists
        if (!$exists->fails() || $given->fails()) {
            return $this->respondBadRequest();
        }
        $board->name = request('name');
        $board->user_id = 1;
        $board->save();
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
            return $this->respondOkWithData([
                'board' => $board,
                'posts' => $board->posts()->get()
            ]);
        } 
        return $this->respondNotFound();
    }
}
