<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        info($session);

        $successMessage = "We have received your payment request and will let you know shortly.";

        return view('success', compact('successMessage'));
    }
}
