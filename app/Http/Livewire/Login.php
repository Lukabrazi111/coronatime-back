<?php

namespace App\Http\Livewire;

use App\Models\User;
use Auth;
use Livewire\Component;

class Login extends Component
{
	public $username;

	public $password;

	protected $rules = [
		'username' => 'required|min:3|max:255',
		'password' => 'required',
	];

	public function mount(User $user)
	{
		$this->username = $user->name;
		$this->password = $user->password;
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName, [
			'username' => 'required|min:3|max:255',
			'password' => 'required|min:3',
		]);
	}

	public function store()
	{
		$this->validate();

		$fieldType = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if (Auth::attempt([$fieldType => $this->username, 'password' => $this->password]))
		{
			$user = Auth::user();

			// Check if email is verified
			if ($this->hasVerifiedAt($user))
			{
                return response()->json($user->name);
			}
			else
			{
				return response()->json([
					'error_message' => 'Please verify your account!',
				]);
			}
		}
		else
		{
			$this->resetFields();
		}
		return redirect()->route('login')->with('error_message', __('Invalid username or password'));
	}

	// Check column {email_verified_at}
	public function hasVerifiedAt(User $user)
	{
		return $user->hasVerifiedEmail();
	}

	public function resetFields()
	{
		$this->username = '';
		$this->password = '';
	}

	public function render()
	{
		return view('livewire.login');
	}
}
