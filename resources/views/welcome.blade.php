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
<header class="flex items-center justify-between">
    <div class="p-4 mx-20">
        <a href="{{ route('companies') }}">Reservation System</a>
    </div>
    @if(Route::has('login'))
        <div class="mx-20 p-4 text-right">
            @auth
                <a href="{{ '/dashboard' }}" class="">Dashboard</a>
            @else
                <a href="{{ 'login' }}" class="">Log in</a>
                @if(Route::has('register'))
                    <a href="{{ 'register' }}" class="ml-4">Register</a>
                @endif
            @endauth
        </div>
    @endif
</header>
<main class="flex-grow">
    <img src="{{ asset('images/services1.jpg') }}" alt="HomePageImage" class="w-max">
    <div>
        <p class="font-extrabold text-2xl mt-5 ml-10">Cities with reservation system</p>
        <ul class="flex justify-center items-center">
            @foreach($companies as $company)
                <a href="{{ route('city-companies', ['city' => $company->city]) }}">
                    <div class="flex m-5 border pl-5 pr-5 pt-2 pb-2">
                        {{ $company->city }} >
                    </div>
                </a>
            @endforeach
        </ul>
    </div>
</main>
<footer class="p-4 bg-black text-white mt-20">
    <p class="font-extrabold text-xl">Useful links</p>
    <ul>
        <li>Contact</li>
        <li>Support</li>
        <li>Report Bug</li>
    </ul>
</footer>
</body>

</html>
