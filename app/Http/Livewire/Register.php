<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $remember;

    public function mount(User $user)
    {
        $this->username = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    protected $rules = [
        'username' => 'required|unique:users,name|min:3|max:255',
        'email' => 'required|unique:users,email|email',
        'password' => 'required|min:3',
        'password_confirmation' => 'required|min:3|same:password',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'username' => 'required|unique:users,name|min:3|max:255',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:3',
        ]);
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if (auth()->attempt(
            request()->only(['name', 'email', 'password']),
            request()->filled($this->remember),
        ));

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
