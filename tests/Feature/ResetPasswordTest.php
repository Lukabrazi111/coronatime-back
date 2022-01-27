<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Str;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function show_password_reset_page()
	{
		$user = User::factory()->create();

		$token = Password::broker()->createToken($user);

		$this->get(route('reset-password.get', [
			'token' => $token,
			'email' => $user->email,
		]))
			->assertSuccessful()
			->assertSee('Reset Password')
			->assertSee('New password')
			->assertSee('Repeat password');
	}

	/** @test */
	public function reset_password_validation()
	{
		$this->post('/reset-password', [
			'email'           => 'some@gmail.com',
			'password'        => 'somepwd',
			'repeat_password' => 'somepwd',
			'token'           => Str::random(60),
		])->assertStatus(302);
	}

	/** @test */
	public function reset_password_request_invalid_email()
	{
		$this->followingRedirects()->from(route('reset-password.get', Str::random(60)))
			->post(route('reset-password.post'), [
				'email' => Str::random(),
			])
			->assertSuccessful();
	}

	/** @test */
	public function reset_password_mismatch()
	{
		$user = User::factory()->create([
			'password' => bcrypt('pwd123'),
		]);

		$token = Password::broker()->createToken($user);

		$password = Str::random();
		$password_confirmation = Str::random();

		$this->followingRedirects()->from(route('reset-password.get', [
			'token' => $token,
		]))
			->post(route('reset-password.post', [
				'token'                 => $token,
				'email'                 => $user->email,
				'password'              => $password,
				'password_confirmation' => $password_confirmation,
			]))
			->assertSuccessful();

		$user->refresh();

		$this->assertFalse(Hash::check($password, $user->password));

		$this->assertTrue(Hash::check('pwd123', $user->password));
	}

	/** @test */
	public function user_can_change_their_password()
	{
		$user = User::factory()->create();

		$token = Password::broker()->createToken($user);

		$this->post(route('reset-password.post', [
			'email'           => $user->email,
			'password'        => 'admin',
			'repeat_password' => 'admin',
			'token'           => $token,
		]))->assertSessionHasNoErrors()
			->assertRedirect(route('password.changed'))
			->assertSessionHas('status', 'Your password has been reset!');
	}
}
