<?php

namespace App\Livewire;

use Livewire\Component;
use Srmklive\PayPal\Services\PayPal;

class PaypalPayment extends Component
{
    public $email;

    public function createPayment()
    {
        // Validate email input
        $this->validate([
            'email' => 'required|email',
        ]);

        // Initialize PayPal provider
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Define a fixed payment amount
        $amount = '100.00'; // Set this to any amount you want to charge

        // Create a PayPal order
        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $amount,
                    ],
                ],
            ],
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel'),
            ],
        ]);

        // Redirect to PayPal if order was created successfully
        if (isset($response['id'])) {
            return redirect($response['links'][1]['href']);
        } else {
            session()->flash('error', 'There was an error with the payment.');
        }
    }

    public function success()
    {
        // Initialize PayPal provider
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        // Capture the payment using the token from the callback URL
        $response = $provider->capturePaymentOrder(request('token'));

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            session()->flash('message', 'Payment was successful!');
            return redirect()->route('/');
        } else {
            session()->flash('error', 'Payment could not be completed.');
            return redirect()->route('/');
        }
    }

    public function cancel()
    {
        session()->flash('error', 'Payment was canceled.');
        return redirect()->route('/');
    }

    public function render()
    {
        return view('livewire.paypal-payment')->layout('layout.website.app');
    }
}
