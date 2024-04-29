<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css" rel="stylesheet">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
<br>
        <center>Login</center> <br>
        <!-- Email Address -->
        <div>
            <x-text-input id="email"   class="input is-primary"
                          type="email"
                          placeholder="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-text-input id="password"   class="input is-primary"
                          type="password"
                          name="password"
                          placeholder="Password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                 <span class="checkbox "> {{ __('Remember me') }} </span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="button is-text" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

             <x-primary-button class="button is-primary">
                 {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
