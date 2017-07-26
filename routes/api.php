<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Auth::routes();

Route::get('/b/{board}', 'BoardController@show'); // goes to a specific board and shows all posts
Route::post('/create', 'BoardController@store'); // create a board
// Route::get('/{board}/create', 'BoardController@create'); // make a post on a board

Route::get('/b/{board}/{post}', 'PostController@show'); // shows a specific post on a board with all the comments
Route::post('/b/{board}/create', 'PostController@store'); // store a post on a board

Route::post('/{post}/comment', 'CommentController@store'); // make a comment on a post