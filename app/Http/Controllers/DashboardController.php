<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;

class DashboardController extends Controller
{
	public function index()
	{
		$countryStatistics = CountryStatistics::select('confirmed', 'deaths', 'recovered')->get();

		$sumConfirmed = $countryStatistics->sum('confirmed');
		$sumRecovered = $countryStatistics->sum('recovered');
		$sumDeaths = $countryStatistics->sum('deaths');

		return view('dashboard', [
			'confirmed' => number_format($sumConfirmed),
			'recovered' => number_format($sumRecovered),
			'deaths'    => number_format($sumDeaths),
		]);
	}
}
