<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Confirm Reservation</title>
</head>
<body class="flex flex-col min-h-screen">
@include('partials.header2')
<main class="flex-grow pl-10 pr-10 pt-2 font-bold">
    <div class="max-w-md mx-auto p-4 pt-6">
        <h1 class="text-2xl">Confirm Your Reservation</h1>
        <p class="text-lg">Please review your reservation details below:</p>
        <div class="bg-white shadow-md rounded px-4 py-6">
            <h2 class="text-lg">Reservation Details</h2>
            <ul class="list-none mb-4">
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Service:</span>
                    <span class="font-bold">{{ $service->name }}</span>
                </li>
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Date:</span>
                    <span class="font-bold">{{ $reservation_date }}</span>
                </li>
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Time:</span>
                    <span class="font-bold">{{ $reservation_time }}</span>
                </li>
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Price:</span>
                    <span class="font-bold">€{{ $service->price }}</span>
                </li>
            </ul>
            <form action="{{ route('stripe.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <input type="hidden" name="reservation_date" value="{{ $reservation_date }}">
                <input type="hidden" name="reservation_time" value="{{ $reservation_time }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Confirm and Pay with Stripe
                </button>
            </form>

            <form action="{{ route('paypal.checkout') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Confirm and Pay with PayPal
                </button>
            </form>
        </div>
    </div>
</main>
@include('partials.footer')
</body>
</html>
