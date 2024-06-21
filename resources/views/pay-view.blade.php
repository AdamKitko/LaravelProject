<!doctype html>
<html lang="english">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Pay for Reservation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="flex flex-col min-h-screen">
@include('partials.header2')
<main class="flex-grow pl-10 pr-10 pt-2 font-bold">
    <div class="max-w-md mx-auto p-4 pt-6">
        <h1 class="text-2xl">Pay for Your Reservation</h1>
        <p class="text-lg">Please enter your payment details below:</p>
        <form>
            <div class="mb-4">
                <label for="card-number" class="block text-gray-700 text-sm font-bold mb-2">Card Number</label>
                <input type="text" id="card-number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="expiration-date" class="block text-gray-700 text-sm font-bold mb-2">Expiration Date</label>
                <input type="text" id="expiration-date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="security-code" class="block text-gray-700 text-sm font-bold mb-2">Security Code</label>
                <input type="text" id="security-code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="name-on-card" class="block text-gray-700 text-sm font-bold mb-2">Name on Card</label>
                <input type="text" id="name-on-card" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Pay Now
            </button>
        </form>
    </div>
</main>
@include('partials.footer')
</body>
</html>
