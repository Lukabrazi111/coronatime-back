<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function test_email_verification_screen_can_be_rendered()
	{
		$response = $this->get(route('verification.send'));
		$response->assertStatus(200);
		$response->assertSee('We have sent you a confirmation email');
	}

	/** @test */
	public function test_email_confirmed_screen_can_be_rendered()
	{
		$response = $this->get(route('email.confirmed'));
		$response->assertStatus(200);
		$response->assertSee('Your account is confirmed, you can sign in');
	}

	/** @test */
	public function test_wrong_token_screen_can_be_rendered()
	{
		$response = $this->get(route('wrong.token'));
		$response->assertStatus(200);
		$response->assertSee('Wrong verification token');
	}

	/** @test */
	public function test_email_verification_screen_renders_after_user_registers()
	{
		$response = $this->post('/register', [
			'name'                  => 'Test User',
			'email'                 => 'test@example.com',
			'password'              => 'password',
			'password_confirmation' => 'password',
		]);
		$response->assertRedirect(route('verification.send'));
		$response->assertSee(route('verification.send'));
	}

	/** @test */
	public function test_email_can_be_verified()
	{
		$user = User::factory()->unverified()->create();
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $user->id,
		]);
		$this->get(route('verify.email', $user->verifyUser->token));
		$this->assertTrue($user->fresh()->email_verified_at != null);
	}

	/** @test */
	public function test_email_cant_be_verified_with_wrong_token()
	{
		$userOne = User::factory()->unverified()->create();
		$userTwo = User::factory()->unverified()->create();
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $userOne->id,
		]);
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $userTwo->id,
		]);
		$this->actingAs($userOne)->get(route('verify.email', $userTwo->verifyUser->token));
		$this->assertTrue($userOne->fresh()->email_verified_at == null);
	}

	/** @test */
	public function test_email_verified_users_are_redirected_to_email_confirmed_page()
	{
		$user = User::factory()->unverified()->create();
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $user->id,
		]);
		$responce = $this->get(route('verify.email', $user->verifyUser->token));
		$this->assertTrue($user->fresh()->email_verified_at != null);
	}

	/** @test */
	public function test_already_email_verified_users_are_redirected_to_email_confirmed_page()
	{
		$user = User::factory()->create();
		$user->email_verified_at != null;
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $user->id,
		]);
		$responce = $this->get(route('verify.email', $user->verifyUser->token));
		$responce->assertRedirect(route('email.confirmed'));
	}

	/** @test */
	public function test_already_email_verified_users_are_not_verified_again()
	{
		$user = User::factory()->create();
		$verificationData = $user->email_verified_at;
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $user->id,
		]);
		$this->get(route('verify.email', $user->verifyUser->token));
		$this->assertTrue($user->fresh()->email_verified_at == $verificationData);
	}

	/** @test */
	public function test_users_with_wrong_token_are_redirected_to_wrong_token_page()
	{
		$user = User::factory()->unverified()->create();
		VerifyUser::create([
			'token'   => Str::random(100),
			'user_id' => $user->id,
		]);
		$wrongToken = Str::random(100);
		$response = $this->actingAs($user)->get(route('verify.email', $wrongToken));
		$this->assertTrue($user->fresh()->email_verified_at == null);
		$response->assertRedirect(route('wrong.token'));
	}
}
