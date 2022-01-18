<?php

namespace Tests\Feature;

use App\Http\Livewire\Logout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class LogoutTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function test_dashboard_has_logout_livewire_component()
	{
		$user = User::factory()->create();
		$this->actingAs($user)->get('/dashboard')
			->assertSuccessful()
			->assertSeeLivewire('logout');
	}

	/** @test */
	public function test_can_not_see_livewire_component_if_not_authorized()
	{
		$this->get('/dashboard')
			->assertDontSeeLivewire('logout')
			->assertStatus(302);
	}

	/** @test */
	public function test_user_can_logout_from_dashboard()
	{
		$user = User::factory()->create();

		$this->actingAs($user)->get('/dashboard')
			->assertSuccessful();

		Livewire::test(Logout::class)
			->call('logout')
			->assertSessionHas('success_message', 'You are logged out')
			->assertRedirect(route('login'));
	}
}
