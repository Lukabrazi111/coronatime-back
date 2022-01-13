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
    protected $signature = 'sync:statistics';

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
        $countries = new CountryStatistics();
        $response = Http::get('https://devtest.ge/countries');

        foreach ($response->json() as $element) {
            sleep(2);

            $countryName = json_encode($element['name']);
            $countryCode = json_encode($element['code']);

            $stats = Http::post('https://devtest.ge/get-country-statistics', $element);

            $decodedStats = json_decode($stats);

            dd($decodedStats);

            $country = [
                'name' => $countryName,
                'code' => $countryCode,
                'confirmed' => $decodedStats->confirmed,
                'recovered' => $decodedStats->recovered,
                'critical' => $decodedStats->critical,
                'deaths' => $decodedStats->deaths,
            ];
        }

        $this->info('You synchronized info successfully');
    }
}
