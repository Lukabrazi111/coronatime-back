<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;

class DashboardController extends Controller
{
	public function index()
	{
		$sumConfirmed = CountryStatistics::sum('confirmed');
		$sumRecovered = CountryStatistics::sum('recovered');
		$sumDeaths = CountryStatistics::sum('deaths');

		return view('dashboard', [
			'confirmed' => number_format($sumConfirmed),
			'recovered' => number_format($sumRecovered),
			'deaths'    => number_format($sumDeaths),
		]);
	}

	public function statistics()
	{
		return CountryStatistics::all();
	}

	public function summarizedStatistics()
	{
		return [
			'confirmed' => CountryStatistics::sum('confirmed'),
			'recovered' => CountryStatistics::sum('recovered'),
			'deaths'    => CountryStatistics::sum('deaths'),
		];
	}
}
