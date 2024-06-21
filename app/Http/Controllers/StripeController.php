<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class StripeController extends Controller
{

    public function index()
    {
        return view('succes');
    }
    public function checkout(): View|Factory|Application
    {
        return view('pay-view');
    }
    public function test(): RedirectResponse
    {
        Stripe::setApiKey(config('stripe.test.sk'));

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'masn',
                        ],
                        'unit_amount'  => 'asdbas',
                    ],
                    'quantity'   => 'asdas',
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('pay-view'),
        ]);

        return redirect()->away($session->url);
    }
    public function success(): View|Factory|Application
    {
        return view('success');
    }
}
