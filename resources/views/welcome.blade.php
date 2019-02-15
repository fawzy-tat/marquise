<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script>
        var Laracasts = {
            csrfToken : "{{ csrf_token() }}",
            stripeKey : "{{ config('services.stripe.key') }} "
        }
        </script>
    </head>
    <body>
        <div id="app">
                <Checkout-form :products = "{{ $products }}"></Checkout-form>
        </div>

        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script src="/js/app.js"></script>    
    </body>
</html>
