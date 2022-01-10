<?php

namespace App\Http\Livewire;

use App\Mail\UserResetPasswordMail;
use App\Models\User;
use Auth;
use Livewire\Component;
use Mail;

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

        $checkEmail = User::where('email', '=', $this->email)->first();

        if ($checkEmail === null) {
            session()->flash('error_message', 'Please enter correct email!');
            return redirect()->route('forgot.password');
        }

        session()->flash('success_message', 'Please check your email to reset a password');

        Mail::to($this->email)->send(new UserResetPasswordMail);

        return redirect()->route('forgot.password');
    }

    public function render()
    {
        return view('livewire.forgot-password');
    }
}
