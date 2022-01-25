<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;

class DashboardController extends Controller
{
	public function index()
	{
		$countryStatistics = CountryStatistics::select('confirmed', 'critical', 'deaths', 'recovered')->get();

		$sumConfirmed = $countryStatistics->sum('confirmed');
		$sumCritical = $countryStatistics->sum('critical');
		$sumCriticalConfirmed = $sumConfirmed + $sumCritical;
		$sumRecovered = $countryStatistics->sum('recovered');
		$sumDeaths = $countryStatistics->sum('deaths');

		return view('dashboard', [
			'confirmed' => number_format($sumCriticalConfirmed),
			'recovered' => number_format($sumRecovered),
			'critical'  => number_format($sumCritical),
			'deaths'    => number_format($sumDeaths),
		]);
	}
}
