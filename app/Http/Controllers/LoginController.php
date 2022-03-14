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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 */
	public function store(LoginRequest $request)
	{
		$request->validated();

		$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password]))
		{
			$user = Auth::user();

			// Check if email is verified
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
//		return redirect()->route('login')->with('error_message', __('Invalid username or password'));
	}

	// Check column {email_verified_at}
	public function hasVerifiedAt(User $user)
	{
		return $user->hasVerifiedEmail();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int     $id
	 *
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
	}
}
