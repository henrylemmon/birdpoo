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
<body class="bg-gray-200">
    <div id="app" class="px-5">
        <nav class="bg-white -mx-5 px-4">
            <div class="container mx-auto">

                <div class="flex items-center justify-between py-2">
                    <!-- Left Side Of Navbar -->
                    <a href="{{ url('/') }}">
                        <h1 class="text-4xl font-semibold">{{ config('app.name', 'Laravel') }}</h1>
                    </a>

                    <!-- Right Side Of Navbar -->
                    <div>
                        @guest
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <a href="#">
                                <img
                                    src="{{ gravatar_url(Auth::user()->email) }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="rounded-full w-12 mr-2"
                                >
                            </a>

                            <div>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
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
