<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
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
	public function store(RegisterRequest $request)
	{
		$request->validated();

		$user = User::create([
			'name'     => $request->username,
			'email'    => $request->email,
			'password' => Hash::make($request->password),
		]);

		VerifyUser::create([
			'token'   => Str::random(60),
			'user_id' => $user->id,
		]);

		Mail::to($user->email)->send(new UserRegisteredMail($user));

		return response()->json([
			'send_verification' => true,
			'message'           => 'We send you verification on email',
		]);
	}

	public function verifyEmail($token)
	{
		$verifiedUser = VerifyUser::where('token', $token)->first();

		if (isset($verifiedUser))
		{
			$user = $verifiedUser->user;

			if (!$user->email_verified_at)
			{
				$user->email_verified_at = Carbon::now();
				$user->save();
				return redirect()->route('account.confirmed');
			}
			else
			{
				return redirect()->route('login')->with('error_message', __('Your email has already been verified!'));
			}
		}
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
