<!doctype html>
<html lang="english">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Project</title>
</head>

<body class="p-4">
@if(Route::has('login'))
    <div class="text-right">
        @auth
            <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="">Log in</a>
            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4">Register</a>
            @endif
        @endauth
    </div>
@endif
<h1 class="font-bold border-b-gray-300 border-b pb-2 mb-3">
    Companies
</h1>
<div>

    <ul>
        @forelse($companies as $company)
            <li class="flex mb-1">
                <span class="flex-1">{{ $company->name }}</span>
                @auth
                    <form action="{{ route('company.delete', $company->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border bg-gray-200 p-1 border-black">Delete</button>
                    </form>
                @endauth
            </li>
        @empty
            <p>No entries</p>
        @endforelse
    </ul>
    @auth
        @include('partials.form')
    @endauth
    @guest
        <p>Not logged in</p>
    @endguest
</div>
</body>

</html>
