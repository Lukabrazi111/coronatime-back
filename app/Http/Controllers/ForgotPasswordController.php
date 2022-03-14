<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
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
	public function store()
	{
	}

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
//			return redirect()->route('forgot.password');
			return response()->json([
				'message' => 'Please check your email to reset password',
			]);
		}

//		session()->flash('error_message', 'The selected email is invalid!');
//		return redirect()->route('forgot.password');
        return response()->json([
            'error_message' => 'The selected email is invalid!',
        ]);
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
