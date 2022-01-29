<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CreateCountryStatisticsTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function making_an_api_request()
	{
		$countries = [
			[
				'code' => 'GE',
				'name' => [
					'ka' => 'საქართველო',
					'en' => 'Georgia',
				],
			],
		];

		$countryResult = [
			'confirmed' => 649,
			'deaths'    => 81905,
			'recovered' => 345122,
		];

		Http::fake([
			'https://devtest.ge/countries'                    => Http::response($countries),
			'https://devtest.ge/get-country-statistics?code=' => Http::response($countryResult),
		]);

		$this->artisan('sync:statistics')->assertSuccessful();

		$this->assertDatabaseHas('country_statistics', ['id' => 1]);
	}
}
