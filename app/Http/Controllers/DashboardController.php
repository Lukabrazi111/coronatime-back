<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;

class DashboardController extends Controller
{
	public function index()
	{
		$countryStatistics = CountryStatistics::all();
        $newCases = 0;
        $sumCritical = 0;
        $sumRecovered = 0;
        $sumDeaths = 0;
		foreach ($countryStatistics as $data)
		{
			$sumConfirmed = $data->sum('confirmed');
			$sumCritical = $data->sum('critical');
			$newCases = $sumConfirmed + $sumCritical;
			$sumRecovered = $data->sum('recovered');
			$sumDeaths = $data->sum('deaths');
		}

		return view('dashboard', [
			'confirmed' => number_format($newCases),
			'recovered' => number_format($sumRecovered),
			'critical'  => number_format($sumCritical),
			'deaths'    => number_format($sumDeaths),
		]);
	}
}
