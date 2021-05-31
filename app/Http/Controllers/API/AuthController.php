<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
	/**
	 * Register api
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required',
		]);
		
		
		if($validator->fails()){
			return $this->sendError('Validation Error.', $validator->errors());
		}
		
		
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$user = User::create($input);
		$success['token'] =  $user->createToken('MyApp')->accessToken;
		$success['name'] =  $user->name;
		
		
		return $this->sendResponse($success, 'User register successfully.');
	}
	
	public function login(Request $request)
	{
		$loginData = $request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);
		
		if(! auth()->attempt($loginData)){
			return $this->sendError('Validation Error.', 'Invalid Credentials');
		}
		$access_token = auth()->user()->createToken('authToken')->accessToken;
		$success['token'] =  $access_token;
		$success['user'] =  auth()->user();
		return $this->sendResponse($success,'user verified successfully');
	}
}
