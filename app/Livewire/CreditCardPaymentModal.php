<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;

class CreditCardPaymentModal extends Component
{
    public $totalPrice;
    public $token; // Token set from the frontend

    public function mount($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function processPayment()
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        // Retrieve existing charges to check if a similar charge exists
        $existingCharges = Charge::all([
            'limit' => 100, // Adjust the limit as needed
            'currency' => 'usd'
        ]);

        // Check if a charge with the same amount and description already exists
        foreach ($existingCharges->data as $existingCharge) {
            if ($existingCharge->amount === $this->totalPrice * 100 &&
                $existingCharge->description === 'Payment for order #1234') {
                $this->dispatch('swal:alert', [
                    'title' => 'Info!',
                    'text' => 'A similar charge already exists.',
                    'icon' => 'info',
                ]);
                return; // Exit if the charge already exists
            }
        }

        // Create a Charge using the token securely sent from the frontend
        $charge = Charge::create([
            'amount' => $this->totalPrice * 100, // Convert dollars to cents
            'currency' => 'usd',
            'source' => $this->token,
            'description' => 'Payment for order #1234', // Customize as needed
        ]);

        if ($charge->status === 'succeeded') {
            // $this->dispatch('paid');
            session(['payment_status' => true]); // Store payment status in session

            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Payment processed successfully.',
                'icon' => 'success',
            ]);
        } else {
            throw new \Exception('Payment not successful. Please try again.');
        }
    } catch (\Exception $e) {
        Log::error('Payment error: ' . $e->getMessage());
        $this->dispatch('swal:alert', [
            'title' => 'Error!',
            'text' => 'An error occurred: ' . $e->getMessage(),
            'icon' => 'error',
        ]);
    }
}


    public function render()
    {
        return view('livewire.credit-card-payment-modal');
    }
}
