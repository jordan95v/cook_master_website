<html lang="{{ App::getLocale('lang') }}" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://kit.fontawesome.com/51d79ea4d7.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>

<body>
    <h1 class="text-2xl">Order Confirmed</h1>
    <p>
        Thank you for your order <b>{{ $user->name }}</b>.<br>
        Your order has been confirmed and will be processed as soon as possible.
    </p>
    <br>
    <p>
        Click <a href="{{ url($invoice->url()) }}" class="link underline hover:link-primary cursor-pointer">here</a>
        to download your invoices.<br>
        Copy the link below if you cannot click.<br>
    </p>
    <p class="underline">{{ url($invoice->url()) }}</p>
    <br>
    <p>
        Please don't hesitate if you have any questions.<br>
        Kind regards,
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</body>

</html>
