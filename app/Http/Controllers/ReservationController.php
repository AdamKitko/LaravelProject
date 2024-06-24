<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        return view('confirm-reservation');
    }

    public function myReservations()
    {
        $user = Auth::user();
        $reservations = Reservation::with('service.company')->where('user_id', $user->id)->get();

        return view('reservations-index', compact('reservations'));
    }
}
