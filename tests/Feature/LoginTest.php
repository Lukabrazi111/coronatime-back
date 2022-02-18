<?php

namespace Tests\Feature;

use App\Http\Livewire\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
	public function login_page_validation_shows_error_on_specific_input()
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
	public function login_page_shows_invalid_username_or_password()
	{
		$this->actingAs(User::factory()->create([
			'name'     => 'Lukabrazi',
			'email'    => 'lukabrazi@redberry.ge',
			'password' => bcrypt('luka123'),
		]));

		Livewire::test(Login::class)
			->set('username', 'Lukabrazi')
			->set('password', 'luka3')
			->call('store')
			->assertRedirect('/login')
			->assertSessionHas('error_message');
	}

	/** @test */
	public function login_page_validation_shows_error_on_specific_input_with_min_requirements()
	{
		Livewire::test(Login::class)
			->set('username', 'ab')
			->set('password', 'ax')
			->assertSeeText('The username must be at least 3 characters.')
			->assertSeeText('The password must be at least 3 characters.');
	}

	/** @test */
	public function login_page_validation_shows_error_username_or_password_is_not_correct()
	{
		$user = User::factory()->create([
			'name'     => 'somename',
			'email'    => 'someemail@gmail.com',
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
			'name'     => 'somename',
			'email'    => 'someemail@gmail.com',
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
			'name'     => 'somename',
			'email'    => 'someemail@gmail.com',
			'password' => bcrypt('pwd123'),
		]);

		Livewire::test(Login::class)
			->set('username', $user->email)
			->set('password', 'pwd123')
			->call('store')
			->assertRedirect('/dashboard');
	}

	/** @test */
	public function login_user_is_not_verified()
	{
		$user = User::factory()->create([
			'name'              => 'luka',
			'password'          => bcrypt('luka123'),
			'email_verified_at' => null,
		]);

		Livewire::actingAs($user)->test(Login::class)
			->set('username', 'luka')
			->set('password', 'luka123')
			->call('store')
			->assertRedirect('/login')
			->assertSessionHas('error_message', 'Please verify your account!');
	}
}
