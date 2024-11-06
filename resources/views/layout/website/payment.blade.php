<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 

    @livewireStyles()
</head>

<body>
    <div class="container">
        <div class="payment-panel">
            <div class="panel-heading">
                <h2 class="panel-title">Credit Card Payment</h2>
            </div>
            {{$slot}}
            
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    

    @livewireScripts()
</body>
</html>
