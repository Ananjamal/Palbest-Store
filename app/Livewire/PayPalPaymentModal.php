<?php

namespace App\Livewire;

use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Livewire\Component;
use Exception;

class PayPalPaymentModal extends Component
{
    public $paypal_email;
    public $totalPrice;

    protected $rules = [
        'paypal_email' => 'required|email|max:255',
    ];

    public function mount($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function processPayment()
    {
        $this->validate();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Create a new item for the transaction
        $item = new Item();
        $item->setName('Total Payment')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(number_format($this->totalPrice, 2, '.', '')); // Ensure correct formatting

        // Create item list and set items
        $itemList = new ItemList();
        $itemList->setItems([$item]); // Ensure this is an array

        // Prepare amount
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(number_format($this->totalPrice, 2, '.', '')); // Ensure correct formatting

        // Create transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Payment for order.');

        // Prepare redirect URLs
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.success')) // Set this route in your web.php
                     ->setCancelUrl(route('payment.cancel'));

        // Create payment
        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]); // This must be an array

        try {
            // Create the payment
            $payment->create($this->getApiContext()); // Get the API context with your credentials
            return redirect($payment->getApprovalLink());
        } catch (Exception $ex) {
            // Handle errors gracefully without logging
            $this->dispatch('swal:alert', [
                'title' => 'Error!',
                'text' => 'An error occurred while processing the payment. Please try again later.',
                'icon' => 'error',
            ]);
        }
    }

    protected function getApiContext()
    {
        // Configure and return your PayPal API context
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),     // ClientID
                env('PAYPAL_CLIENT_SECRET')  // ClientSecret
            )
        );

        // Set additional options if necessary
        $apiContext->setConfig([
            'mode' => env('PAYPAL_MODE', 'sandbox'), // Can be 'sandbox' or 'live'
        ]);

        return $apiContext;
    }

    public function render()
    {
        return view('livewire.pay-pal-payment-modal');
    }
}
