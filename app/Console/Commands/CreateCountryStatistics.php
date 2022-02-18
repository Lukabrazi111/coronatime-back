<?php

namespace App\Console\Commands;

use App\Models\CountryStatistics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateCountryStatistics extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'create:country-statistics';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sync information from devtest.ge';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$countries = Http::get('https://devtest.ge/countries')->json();

		foreach ($countries as $country)
		{
			$response = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			]);

			sleep(2);

			$result = $response->json();

			$translations = [
				'en' => $country->name->en,
				'ka' => $country->name->ka,
			];

			CountryStatistics::updateOrCreate(
				[
					'code'      => $result->code,
					'name'      => $translations,
					'confirmed' => $result->confirmed,
					'recovered' => $result->recovered,
					'critical'  => $result->critical,
					'deaths'    => $result->deaths,
				]
			);
		}

		$this->info('You synchronized info successfully');
	}
}
