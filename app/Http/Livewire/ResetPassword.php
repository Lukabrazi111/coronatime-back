<?php

namespace App\Http\Livewire;

use App\Mail\UserResetPasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Password;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    public $password;
    public $repeat_password;

    protected $rules = [
        'password' => 'required|min:3',
        'repeat_password' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetPassword()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
