<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param LoginRequest $request
	 */
	public function store(LoginRequest $request)
	{
		$request->validated();

		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password]))
		{
			$user = Auth::user();

			if ($this->hasVerifiedAt($user))
			{
				$token = $user->createToken('auth_token')->plainTextToken;

				return response()->json([
					'access_token' => $token,
					'loggedIn'     => true,
					'username'     => $request->username,
					'password'     => $request->password,
				]);
			}

			return response()->json([
				'error_message' => 'Please verify your account!',
			]);
		}

		return response()->json(['error_message' => 'Invalid username or password']);
	}

	public function hasVerifiedAt(User $user)
	{
		return $user->hasVerifiedEmail();
	}
}
