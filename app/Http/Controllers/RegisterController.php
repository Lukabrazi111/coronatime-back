<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param RegisterRequest $request
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

    /**
     * Fill email_verified_at column.
     *
     * @param $token
     */
	public function verifyEmail($token)
	{
		$verifiedUser = VerifyUser::where('token', $token)->first();

		if ($verifiedUser)
		{
			$user = $verifiedUser->user;

			if (!$user->email_verified_at)
			{
				$user->email_verified_at = Carbon::now();
				$user->save();
                return response()->json([
                    'message' => 'Account Confirmed',
                ]);
			}

            return response()->json([
                'error_message' => 'Your email has already been verified!'
            ]);
		}
	}
}
