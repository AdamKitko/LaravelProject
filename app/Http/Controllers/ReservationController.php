<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reserve');
    }

    public function pay()
    {
        return view('pay-view');
    }
}
