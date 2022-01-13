<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countryStatistics = CountryStatistics::all();
        foreach ($countryStatistics as $data) {
            $sumConfirmed = $data->sum('confirmed');
            $sumCritical = $data->sum('critical');
            $newCases = $sumConfirmed + $sumCritical;
            $sumRecovered = $data->sum('recovered');
            $sumDeaths = $data->sum('deaths');
        }

        return view('dashboard', [
            'confirmed' => strval($newCases),
            'recovered' => $sumRecovered,
            'critical' => $sumCritical,
            'deaths' => $sumDeaths,
        ]);
    }
}
