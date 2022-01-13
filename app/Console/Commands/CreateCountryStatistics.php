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
        $file = Http::get('https://devtest.ge/countries')->body();
        $data = json_decode($file);
        foreach ($data as $country) {
            $response = Http::asForm()->post('https://devtest.ge/get-country-statistics', [
                'code' => $country->code,
            ]);
            sleep(2);
            $res = json_decode($response);
            $translations = [
                'en' => $country->name->en,
                'ka' => $country->name->ka,
            ];
            CountryStatistics::updateOrCreate(
                [
                    'code'      => $res->code,
                    'name'      => $translations,
                    'confirmed' => $res->confirmed,
                    'recovered' => $res->recovered,
                    'critical'  => $res->critical,
                    'deaths'    => $res->deaths,
                ]
            );
        }

        $this->info('You synchronized info successfully');
    }
}
