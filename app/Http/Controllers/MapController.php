<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Map;
use App\Models\ParkingLot;
use Illuminate\Routing\Controller;

class MapController extends Controller
{
    public function index(string $city)
    {
        $cityData = Map::where('name', $city)->first();
        $parkingData = ParkingLot::where('city', $city)->get();

        if (!$cityData) {
            return redirect()->back()->with('error', 'City not found.');
        }

        $companies = Company::where('city', $city)->get();
        return view('map', ['cityData' => $cityData, 'companies' => $companies, 'parkingData' => $parkingData]);
    }
}
