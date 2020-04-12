<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-light bg-page">
    <div id="app" class="px-5">
        <nav class="bg-header -mx-5 px-4">
            <div class="container mx-auto">

                <div class="flex items-center justify-between py-2">
                    <!-- Left Side Of Navbar -->
                    <a href="{{ url('/') }}">
                        <h1 class="text-4xl font-semibold">{{ config('app.name', 'Laravel') }}</h1>
                    </a>

                    <!-- Right Side Of Navbar -->
                    <div class="flex items-center ml-auto">
                        @guest
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <theme-switcher></theme-switcher>

                            <dropdown align="right" width="200px">
                                <template v-slot:trigger>
                                    <button class="flex items-center focus:outline-none">
                                        <img
                                            src="{{ gravatar_url(Auth::user()->email) }}"
                                            alt="{{ Auth::user()->name }}"
                                            class="rounded-full w-12 mr-3"
                                        >

                                        {{ auth()->user()->name }}
                                    </button>

                                </template>

                                <a
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                    class="dropdown-menu-link"
                                >
                                    {{ __('Logout') }}
                                </a>

                                <form
                                    id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    style="display: none;"
                                >
                                    @csrf
                                </form>
                            </dropdown>

                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
