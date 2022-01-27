<?php

namespace Tests\Feature;

use App\Http\Livewire\ForgotPassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function forgot_password_page_has_livewire_component()
	{
		$this->get(route('forgot.password'))
			->assertSuccessful()
			->assertSeeLivewire('forgot-password');
	}

	/** @test */
	public function forgot_password_email_required_validation_works_properly()
	{
		Livewire::test(ForgotPassword::class)
			->set('email', '')
			->call('send')
			->assertHasErrors(['email' => 'required'])
			->assertSee('The email field is required.');
	}

	/** @test */
	public function forgot_password_properly_email_check()
	{
		Livewire::test(ForgotPassword::class)
			->set('email', 'dsaxdasx')
			->call('send')
			->assertHasErrors(['email' => 'email'])
			->assertSee('The email must be a valid email address.');
	}

	/** @test */
	public function forgot_password_page_email_does_not_exist()
	{
		$user = User::factory()->create([
			'name'  => 'luka',
			'email' => 'luka@gmail.com',
		]);

		Livewire::actingAs($user)->test(ForgotPassword::class)
			->set('email', 'invalidemail@gmail.com')
			->call('send')
			->assertSessionHas('error_message', 'The selected email is invalid!')
			->assertRedirect(route('forgot.password'));

		$this->assertDatabaseHas('users', [
			'email' => 'luka@gmail.com',
		]);
	}

	/** @test */
	public function forgot_password_page_email_exists()
	{
		$user = User::factory()->create([
			'name'  => 'luka',
			'email' => 'luka@gmail.com',
		]);

		Livewire::actingAs($user)->test(ForgotPassword::class)
			->set('email', $user->email)
			->call('send')
			->assertSessionHas('success_message', 'Please check your email to reset password')
			->assertRedirect(route('forgot.password'));

		$this->assertDatabaseHas('users', [
			'email' => 'luka@gmail.com',
		]);
	}
}
