<!doctype html>
<html lang="english">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Document</title>
    </head>

    <body class="p-4">
    @if(Route::has('login'))
        <div class="text-right">
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
        <h1 class="pb-2 mb-3 font-bold border-b border-b-gray-300">Companies</h1>
        <ul>
            @forelse($companies as $company)
                <li class="flex mb-1">
                    <span class="flex-1">
                        {{ $company->name }}
                    </span>
                    @auth
                        <form action="{{ route('company.delete', $company->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1 bg-gray-200 border border-black">Delete</button>
                        </form>
                    @endauth
                </li>
            @empty
                <p>No Company Entered!</p>
            @endforelse
        </ul>
    @auth
        <form method="POST" action="{{ route('company.create') }}">
            @csrf
            <h3 class="pb-2 mt-4 mb-3 font-bold border-b border-b-gray-300">Add a new company</h3>
            <div class="flex">
                <div class="flex-1">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="p-1 border border-gray-200">
                </div>
                <input type="submit" name="send" value="Submit" class="p-1 bg-gray-200 border border-black cursor-pointer">
            </div>
        </form>
    @endauth
    </body>

</html>
