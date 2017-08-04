<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends ApiController
{
	protected $hidden = ['created_at', 'updated_at'];
	
	public function register(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required',
		]);
		
		User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password'))
		]);

		return $this->respondCreated();
	}

	public function login(Request $request)
	{
		// validate login
		$this->validate($request, [
			// 'name' => 'required',
			'email' => 'required|email',
			'password' => 'required',
		]);
		$credentials = $request->only(['email', 'password']);

		// try to create token
		try {
			if (!$token = JWTAuth::attempt($credentials)) {
				return $this->respondBadRequest('Invalid Credentails.');
			}
		} catch (JWTException $e) {
			return $this->respondServerError('Could not create token.');
		}
		// return token if created
		return $this->respondOkWithData(['token' => $token]);
	}
}