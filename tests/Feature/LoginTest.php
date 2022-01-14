<?php

namespace Tests\Feature;

use App\Http\Livewire\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_has_livewire_login_component()
    {
        $this->get('/login')
            ->assertSuccessful()
            ->assertSeeLivewire('login')
            ->assertSeeText('Welcome back');
    }

    /** @test */
    public function user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/login')
            ->assertRedirect('/home');
    }

    /** @test */
    public function login_page_validation_shows_errors()
    {
        Livewire::test(Login::class)
            ->set('username', '')
            ->set('password', '')
            ->call('store')
            ->assertHasErrors([
                'username' => 'required',
                'password' => 'required',
            ])->assertSee('The username field is required.');
    }

    /** @test */
    public function register_page_validation_shows_error_on_specific_input()
    {
        Livewire::test(Login::class)
            ->set('username', 'abcd')
            ->set('password', '')
            ->call('store')
            ->assertHasErrors([
                'password' => 'required',
            ])->assertSee('The password field is required.');
    }

    /** @test */
    public function login_page_validation_shows_error_username_or_password_is_not_correct()
    {
        $user = User::factory()->create([
            'name' => 'somename',
            'email' => 'someemail@gmail.com',
            'password' => bcrypt('pwd123'),
        ]);

        Livewire::test(Login::class)
            ->set('username', $user->name)
            ->set('password', 'pwd12345')
            ->call('store')
            ->assertRedirect('/login')
            ->assertSessionHas('error_message');
    }

    /** @test */
    public function login_page_validation_shows_error_email_or_password_is_not_correct()
    {
        $user = User::factory()->create([
            'name' => 'somename',
            'email' => 'someemail@gmail.com',
            'password' => bcrypt('pwd123'),
        ]);

        Livewire::test(Login::class)
            ->set('username', $user->email)
            ->set('password', 'pwd12345')
            ->call('store')
            ->assertRedirect('/login')
            ->assertSessionHas('error_message');
    }

    /** @test */
    public function login_page_validation_was_successful()
    {
        $user = User::factory()->create([
            'name' => 'somename',
            'email' => 'someemail@gmail.com',
            'password' => bcrypt('pwd123'),
        ]);

        Livewire::test(Login::class)
            ->set('username', $user->email)
            ->set('password', 'pwd123')
            ->call('store')
            ->assertRedirect('/home');
    }
}
