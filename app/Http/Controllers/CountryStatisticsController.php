<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountryStatistics;
use Illuminate\Support\Facades\Http;

class CountryStatisticsController extends Controller
{
    public function index()
    {
        $country = CountryStatistics::all();

        return view('dashboard-by-country', ['country' => $country]);
    }
}
