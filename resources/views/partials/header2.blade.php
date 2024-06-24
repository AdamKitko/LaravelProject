<header class="flex items-center justify-between">
    <div class="p-4 mx-20">
        <a href="{{ route('welcome') }}">Reservation System</a>
    </div>
    @if(Route::has('login'))
        <div class="relative mx-20 p-4 text-right" x-data="{ dropdownOpen: false }">
            @auth
                <a href="{{ route('company.create') }}"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create Company
                </a>
                <button id="dropdownDividerButton" data-dropdown-toggle="dropdownDivider"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">{{ Auth::user()->name }}
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div id="dropdownDivider"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDividerButton">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('user.reservations') }}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Moje rezervácie</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="{{ route('logout') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ 'login' }}" class="">Log in</a>
                @if(Route::has('register'))
                    <a href="{{ 'register' }}" class="ml-4">Register</a>
                @endif
            @endauth
        </div>
    @endif
</header>
