<!doctype html>
<html lang="english">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Project</title>
</head>

<body class="flex flex-col min-h-screen">
@include('partials.header2')
<main class="flex-grow">
    <img src="{{ asset('images/services1.jpg') }}" alt="HomePageImage" class="w-max">
    <div>
        <p class="font-extrabold text-2xl mt-5 ml-10">Cities with reservation system</p>
        <ul class="flex justify-center items-center">
            @foreach($cities as $city)
                <a href="{{ route('city-companies', ['city' => $city->city]) }}">
                    <div class="flex m-5 border pl-5 pr-5 pt-2 pb-2">
                        {{ $city->city }} >
                    </div>
                </a>
            @endforeach
        </ul>
    </div>
</main>
@include('partials.footer')
</body>

</html>
