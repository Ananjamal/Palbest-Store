<div>
    @if ($success)
        <h1>Payment Successful</h1>
        <p>Your payment has been processed successfully!</p>
        <p>Payment ID: {{ $paymentId }}</p>
        <p>Payer ID: {{ $PayerID }}</p>
        <a href="{{ route('/') }}" class="btn btn-primary">Return to Home</a>
    @elseif ($cancel)
        <h1>Payment Canceled</h1>
        <p>Your payment has been canceled. You can try again or return to your cart.</p>
        <a href="{{ route('cart') }}" class="btn btn-secondary">Go to Cart</a>
        <a href="{{ route('/') }}" class="btn btn-primary">Return to Home</a>
    @else
        <h1>Loading...</h1>
    @endif
</div>
