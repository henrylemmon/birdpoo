@extends('layouts.app')

@section('content')
    <div class="card w-1/3">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                        {{ __('E-Mail Address') }}
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight{{ $errors->has('email') ? ' border-red-500' : '' }}">

                    @if ($errors->has('email'))
                        <span class="text-red-500 text-xs italic" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                        {{ __('Password') }}
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight{{ $errors->has('password') ? ' border-red-500' : '' }}">

                    @if ($errors->has('password'))
                        <span class="text-red-500 text-xs italic" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                    @endif
                </div>

                <div class="mb-4 flex items-center">
                    <input class="mr-1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="text-gray-700 text-sm font-bold" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="mb-4 flex items-center">
                    <button type="submit" class="button-blue mr-6">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="text-blue-500 text-sm font-bold" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
