<!doctype html>
<html lang="english">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Companies in {{ $city }}</title>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="flex flex-col min-h-screen">
@include('partials.header1')
<main class="flex-grow">
    <div>
        <p class="font-extrabold text-2xl mt-5 ml-10">Companies in {{ $city }}</p>
        <ul class="flex justify-center items-center flex-wrap">
            @foreach($companies as $company)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ml-4 w-1/3">
                    <a href="{{ route('company', ['city' => $city, 'name' => $company->name]) }}">
                        <img class="rounded-t-lg" src="{{ $company->image }}" alt=""/>
                    </a>
                    <div class="p-5">
                        <a href="{{ route('company', ['city' => $city, 'name' => $company->name]) }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $company->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $company->description }}</p>
                    </div>
                </div>

            @endforeach
        </ul>
    </div>
</main>
@include('partials.footer')
</body>
</html>
