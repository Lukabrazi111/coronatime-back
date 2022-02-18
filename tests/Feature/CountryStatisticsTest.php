<?php

namespace Tests\Feature;

use App\Http\Livewire\CountryStatisticsLivewire;
use App\Models\CountryStatistics;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CountryStatisticsTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function dashboard_page_has_country_statistics_livewire_component()
	{
		$user = User::factory()->create();
		$this->actingAs($user)->get(route('dashboard.country'))
			->assertSeeLivewire('country-statistics-livewire')
			->assertSuccessful()
			->assertStatus(200);
	}

	/** @test */
	public function country_statistics_search_functionality()
	{
		User::factory()->create();

		CountryStatistics::factory()->create([
			'name' => 'Afghanistan',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Russia',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Georgia',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Albania',
		]);

		Livewire::test(CountryStatisticsLivewire::class)
			->set('search', 'Afgha')
			->assertSee('Afghanistan')
			->assertDontSee('Russia');
	}

	/** @test */
	public function country_statistics_search_functionality_nothing_found()
	{
		CountryStatistics::factory()->create([
			'name' => 'Afghanistan',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Russia',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Georgia',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Albania',
		]);

		Livewire::test(CountryStatisticsLivewire::class)
			->set('search', 'dxasdxasxdsa')
			->assertDontSee('Afghanistan')
			->assertSee('Nothing found for this query');
	}

	/** @test */
	public function country_statistics_sorting_functionality()
	{
		CountryStatistics::factory()->create([
			'name' => 'Albania',
		]);

		CountryStatistics::factory()->create([
			'name' => 'Russia',
		]);

		Livewire::test(CountryStatisticsLivewire::class)
			->call('sortBy', 'name')
			->assertSeeInOrder(['Albania', 'Russia'])
			->call('sortBy', 'name')
			->assertSeeInOrder(['Russia', 'Albania']);
	}
}
