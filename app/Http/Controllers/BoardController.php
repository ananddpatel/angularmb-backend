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
        $validator = $this->validateStore([
            'name' => 'required|exists:' . $board->getTable() . ',' . $board->getPrimaryKey()
        ]);
        // true if already exists
        if (!$validator->fails()) {
            return $this->respondBadRequest();
        }
        $board->name = request('name');
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
