<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje rezervácie</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
@include('partials.header2')
<div class="flex-grow container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Moje rezervácie</h1>
    @if($reservations->isEmpty())
        <p>Žiadne aktuálne rezervácie</p>
    @else
        <ul>
            @foreach($reservations as $reservation)
                <li class="mb-2 p-2 border border-gray-300 rounded">
                    <div><span class="font-bold">Podnik: </span>{{ $reservation->service->company->name }}</div>
                    <div><span class="font-bold">Adresa: </span>{{ $reservation->service->company->city }}, {{ $reservation->service->company->address }}</div>
                    <div><span class="font-bold">Služba: </span>{{ $reservation->service->name }}</div>
                    <div><span class="font-bold">Začína sa: </span>{{ \Carbon\Carbon::parse($reservation->starts_at)->format('d.m.Y H:i') }}</div>
                    <div><span class="font-bold">Končí sa: </span>{{ \Carbon\Carbon::parse($reservation->ends_at)->format('d.m.Y H:i') }}</div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>
