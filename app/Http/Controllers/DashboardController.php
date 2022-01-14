<?php

namespace App\Http\Controllers;

use App\Models\CountryStatistics;
use App\Models\User;
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
            'confirmed' => strval(number_format($newCases)),
            'recovered' => number_format($sumRecovered),
            'critical' => number_format($sumCritical),
            'deaths' => number_format($sumDeaths),
        ]);
    }
}
