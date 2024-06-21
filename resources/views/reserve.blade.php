<!doctype html>
<html lang="english">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Confirm Reservation</title>
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
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
                    <span class="font-bold">Service Name</span>
                </li>
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Date:</span>
                    <span class="font-bold">Date of Reservation</span>
                </li>
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Time:</span>
                    <span class="font-bold">Time of Reservation</span>
                </li>
                <li class="flex justify-between py-2">
                    <span class="text-gray-600">Price:</span>
                    <span class="font-bold">€ </span>
                </li>
            </ul>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="location.href='{{ route('pay-view') }}'">
                Confirm and Pay
            </button>
        </div>
    </div>
</main>
@include('partials.footer')
</body>
</html>
