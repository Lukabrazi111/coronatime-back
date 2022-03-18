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

			$statistic = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			])->json();

			sleep(2);

			CountryStatistics::updateOrCreate(
				[
					'code'      => $statistic['code'],
					'name'      => $country['name'],
					'confirmed' => $statistic['confirmed'],
					'recovered' => $statistic['recovered'],
					'critical'  => $statistic['critical'],
					'deaths'    => $statistic['deaths'],
				]
			);
		}

		$this->info('You synchronized info successfully');
	}
}
