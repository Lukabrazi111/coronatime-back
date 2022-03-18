<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	/**
	 * Send reset password link on email
	 *
	 * @param ForgotPasswordRequest $request
	 * */
	public function send(ForgotPasswordRequest $request)
	{
		$request->validated();

		$userEmail = User::where('email', '=', $request->email)->first();

		$status = Password::sendResetLink(['email' => $userEmail]);

		if ($status === Password::RESET_LINK_SENT)
		{
			back()->with(['status' => __($status)]);
			session()->flash('success_message', 'Please check your email to reset password');
			return response()->json([
				'message' => 'Please check your email to reset password',
			]);
		}

        return response()->json([
            'error_message' => 'The selected email is invalid!',
        ]);
	}
}
