<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Password;

class ForgotPassword extends Component
{
	public $email;

	protected $rules = [
		'email' => 'required|email',
	];

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}

	public function send()
	{
		$this->validate();

		$userEmail = User::where('email', '=', $this->email)->first();

		$status = Password::sendResetLink(['email' => $userEmail]);

		if ($status === Password::RESET_LINK_SENT)
		{
			back()->with(['status' => __($status)]);
			session()->flash('success_message', 'Please check your email to reset password');
			return redirect()->route('forgot.password');
		}
		else
		{
			session()->flash('error_message', 'The selected email is invalid!');
			return redirect()->route('forgot.password');
		}
	}

	public function render()
	{
		return view('livewire.forgot-password');
	}
}
