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
<header class="flex items-center justify-between">
    <div class="p-4 mx-20 flex justify-between items-center">
        <a href="{{ route('companies') }}">Reservation System</a>
        <span id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="text-blue-500 text-sm px-5 py-2.5 text-center inline-flex items-center cursor-pointer"
                type="button">{{ $city }}
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 4 4 4-4"/>
            </svg>
        </span>
        <div id="dropdown"
             class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                @foreach($allcompanies as $company)
                    <a href="{{ route('city-companies', ['city'=>$company->city]) }}">
                        <li class="pl-2">
                            {{ $company->city }}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
    <div>

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
    <div>
        <p class="font-extrabold text-2xl mt-5 ml-10">Companies in {{ $city }}</p>
        <ul class="flex justify-center items-center flex-wrap">
            @foreach($companies as $company)
                <div class="flex m-5 border pl-5 pr-5 pt-2 pb-2">
                    {{ $company->name }}
                </div>
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
