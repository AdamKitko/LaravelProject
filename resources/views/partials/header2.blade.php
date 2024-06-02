<header class="flex items-center justify-between">
    <div class="p-4 mx-20">
        <a href="{{ route('welcome') }}">Reservation System</a>
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
