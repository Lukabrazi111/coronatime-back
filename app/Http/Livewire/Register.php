<?php

namespace App\Http\Livewire;

use App\Http\Controllers\MailController;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

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

    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        VerifyUser::create([
            'token' => Str::random(60),
            'user_id' => $user->id,
        ]);
        
        Mail::to($user->email)->send(new UserRegisteredMail($user));

        // Remember token
        // if (auth()->attempt(
        //     request()->only(['name', 'email', 'password']),
        //     request()->filled($this->remember),
        // ));

        return redirect()->route('login');
    }

    public function verifyEmail($token)
    {
        $verifiedUser = VerifyUser::where('token', $token)->first();

        if (isset($verifiedUser)) {
            $user = $verifiedUser->user;

            if (!$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                return redirect()->route('login')->with('success_message', 'Your email has been verified!');
            } else {
                return redirect()->back()->with('error_message', 'Your email has already been verified!');
            }
        }
    }

    public function render()
    {
        return view('livewire.register');
    }
}