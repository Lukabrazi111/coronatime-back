<?php

namespace App\Http\Livewire;

use App\Models\User;
use Auth;
use Livewire\Component;
use Request;

class Login extends Component
{
    public $username;
    public $password;

    public function mount(User $user)
    {
        $this->username = $user->name;
        $this->password = $user->password;
    }

    protected $rules = [
        'username' => 'required|min:3|max:255',
        'password' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'username' => 'required|min:3|max:255',
            'password' => 'required|min:3',
        ]);
    }

    public function resetFields()
    {
        $this->username = '';
        $this->password = '';
    }

    // Check column {email_verified_at}
    public function hasVerifiedAt(User $user)
    {
        return $user->hasVerifiedEmail();
    }

    public function store()
    {
        $this->validate();

        $fieldType = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$fieldType => $this->username, 'password' => $this->password])) {
            $user = Auth::user();

            // Check if email is verified
            if ($this->hasVerifiedAt($user)) {
                session()->flash('success_message', 'You are logged in successfully');
                return redirect()->route('dashboard');
            }
        } else {
            $this->resetFields();
            return redirect()->route('login')->with('error_message', 'Invalid username or password');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
