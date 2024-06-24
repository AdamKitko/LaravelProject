<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
    <div class="text-center">
        <svg style="height: 3rem; width: 3rem; color: green;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10s-4.48 10-10 10z"></path>
        </svg>
        <h1 class="mt-4 text-2xl font-bold text-gray-900">Payment Successful</h1>
        <p class="mt-2 text-gray-600">{{ $successMessage }}</p>
        <a href="{{ url('/') }}" class="mt-4 inline-block px-6 py-2 text-black bg-blue-600 rounded-full hover:bg-blue-700">Go to Home</a>
    </div>
</div>
</body>
</html>
