<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Notifications\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Password;

class ResetPasswordController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 */
	public function store(ResetPasswordRequest $request)
	{
		$request->validated();

		$status = Password::reset(
			$request->only('email', 'password', 'repeat_password', 'token'),
			function ($user, $password) {
				$user->forceFill([
					'password' => Hash::make($password),
				])->setRememberToken(Str::random(60));

				$user->save();

				event(new PasswordReset($user));
			}
		);

		if ($status === Password::PASSWORD_RESET)
		{
			return redirect()->route('password.changed')->with('status', __($status));
		}
		else
		{
			session()->flash('error_message', 'Please try again...');
			return back()->withErrors(['email' => [__($status)]]);
		}
	}
}
