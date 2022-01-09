<?php

namespace Tests\Feature;

use App\Http\Livewire\Register;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_page_has_register_livewire_component()
    {
        $this->get('/register')
        ->assertSeeLivewire('register')
        ->assertSee('Welcome to Coronatime');
    }

    /** @test */
    public function user_cannot_view_a_register_form_when_authenticated()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/register')
            ->assertRedirect('/');
    }

    /** @test */
    public function register_page_validation_shows_errors()
    {
        Livewire::test(Register::class)
            ->set('username', '')
            ->set('email', '')
            ->set('password', '')
            ->set('password_confirmation', '')
            ->call('store')
            ->assertHasErrors([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required',
            ])->assertSee('The username field is required.');
    }

    /** @test */
    public function register_page_validation_shows_error_on_specific_input()
    {
        Livewire::test(Register::class)
            ->set('username', 'abcd')
            ->set('email', '')
            ->set('password', 'abcd')
            ->set('password_confirmation', 'abcd')
            ->call('store')
            ->assertHasErrors([
                'email' => 'required',
            ])->assertSee('The email field is required.');
    }

    /** @test */
    public function register_page_validation_shows_error_if_username_already_exist()
    {
        $userExist = User::factory()->create([
            'name' => 'Lukabrazi123',
            'email' => 'luka@gmail.com',
            'password' => bcrypt('luka123'),
        ]);

        Livewire::test(Register::class)
            ->set('username', $userExist->name)
            ->set('email', 'someemail@gmail.com')
            ->set('password', 'abcd')
            ->set('password_confirmation', 'abcd')
            ->call('store')
            ->assertHasErrors([
                'username' => 'unique',
            ])->assertSee('The username has already been taken.');
    }

    /** @test */
    public function register_page_validation_shows_error_if_email_already_exist()
    {
        $userExist = User::factory()->create([
            'name' => 'Lukabrazi123',
            'email' => 'already@gmail.com',
            'password' => bcrypt('luka123'),
        ]);

        Livewire::test(Register::class)
            ->set('username', 'somenickname')
            ->set('email', $userExist->email)
            ->set('password', 'abcd')
            ->set('password_confirmation', 'abcd')
            ->call('store')
            ->assertHasErrors([
                'email' => 'unique',
            ])->assertSee('The email has already been taken.');
    }

    /** @test */
    public function register_page_validation_shows_error_must_match()
    {
        Livewire::test(Register::class)
            ->set('username', 'somenickname')
            ->set('email', 'someemail@gmail.com')
            ->set('password', 'abcd')
            ->set('password_confirmation', 'abcdefg')
            ->call('store')
            ->assertHasErrors([
                'password_confirmation' => 'same',
            ])->assertSee('The password confirmation and password must match.');
    }

    /** @test */
    public function register_page_validation_verification_was_successful()
    {
        Livewire::test(Register::class)
            ->set('username', 'somenickname')
            ->set('email', 'someemail@gmail.com')
            ->set('password', 'abcd')
            ->set('password_confirmation', 'abcd')
            ->call('store')
            ->assertHasNoErrors([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required',
            ]);
    }

    /** @test */
    public function register_page_validation_verification_was_successfully_send_to_email()
    {
        Livewire::test(Register::class)
            ->set('username', 'somenickname')
            ->set('email', 'someemail@gmail.com')
            ->set('password', 'abcd')
            ->set('password_confirmation', 'abcd')
            ->call('store')
            ->assertHasNoErrors([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'password_confirmation' => 'required',
            ])->assertSessionHas('success_message');
    }
}
