<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Service;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function payWithPayPal(Request $request)
    {
        $service = Service::findOrFail($request->service_id);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($service->name)
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($service->price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($service->price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Payment for service reservation');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.success'))
            ->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);


        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            info('PayPal Connection Exception: ' . $ex->getMessage());
            info('PayPal Connection Data: ' . json_encode($ex->getData()));
            return redirect()->route('home')->with('error', 'Some error occurred, please try again later.');
        } catch (\Exception $ex) {
            info('General Exception: ' . $ex->getMessage());
            return redirect()->route('home')->with('error', 'Some error occurred, please try again later.');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return view('success', ['successMessage' => 'Payment successful!']);
        } catch (PayPalConnectionException $ex) {
            return redirect()->route('home')->with('error', 'Some error occurred, please try again later.');
        }
    }

    public function paypalCancel()
    {
        return redirect()->route('home')->with('error', 'Payment canceled.');
    }
}
