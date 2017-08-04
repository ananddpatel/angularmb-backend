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

Route::post('/register', 'UserController@register'); // register a new USER
Route::post('/login', 'UserController@login'); // login route

Route::get('/b/{board}', 'BoardController@show'); // goes to a specific BOARD and shows all POSTS
Route::get('/b/{board}/{post}', 'PostController@show'); // shows a specific POST on a board with all the COMMENTS

Route::middleware(['auth.jwt'])->group(function () {
	Route::post('/create', 'BoardController@store'); // store a BOARD
	Route::post('/b/{board}/create', 'PostController@store'); // store a POST on a BOARD
	Route::post('/{post}/comment', 'CommentController@store'); // store a COMMENT on a POST
});
