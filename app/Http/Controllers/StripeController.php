<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\Service;

class StripeController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('stripe', compact('services'));
    }

    public function showReservationForm($id)
    {
        try {
            $service = Service::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Service not found');
        }

        $reservation_date = '2024-06-22';
        $reservation_time = '14:00';
        return view('confirm-reservation', compact('service', 'reservation_date', 'reservation_time'));
    }

    public function stripeCheckout(Request $request)
    {
        $service = Service::findOrFail($request->service_id);
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));

        $redirectUrl = route('stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $response = $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $service->name,
                        ],
                        'unit_amount' => $service->price * 100,
                        'currency' => 'EUR',
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        session([
            'service_id' => $service->id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time
        ]);

        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));
        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        $user = Auth::user();

        $serviceId = session('service_id');
        $reservationDate = session('reservation_date');
        $reservationTime = session('reservation_time');
        $service = Service::findOrFail($serviceId);

        $startDateTime = new \DateTime("$reservationDate $reservationTime");
        $endDateTime = (clone $startDateTime)->modify("+{$service->length} minutes");

        Reservation::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'starts_at' => $startDateTime,
            'ends_at' => $endDateTime,
        ]);

        $successMessage = "We have received your payment request and your reservation has been confirmed.";
        return view('success', compact('successMessage'));
    }
}
