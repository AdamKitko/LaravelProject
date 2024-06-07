<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Routing\Controller;

class ServiceController extends Controller
{
    public function getServices()
    {
        $services = Service::all();
        return view('company', ['services' => $services]);
    }
}
