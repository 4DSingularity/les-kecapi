<x-guest-layout>
    
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Logo atau Judul -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <h1 class="font-serif text-3xl font-bold text-coklat-tua">Login Guru</h1>
            </a>
            <p class="text-sm text-coklat-muda mt-1">Selamat datang kembali!</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-coklat-muda">{{ __('Email') }}</label>
                
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                       class="block mt-1 w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">
                
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-coklat-muda">{{ __('Password') }}</label>

                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="block mt-1 w-full border-gray-300 focus:border-terakota focus:ring-terakota rounded-md shadow-sm">

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="rounded border-gray-300 text-terakota shadow-sm focus:ring-terakota">
                    <span class="ms-2 text-sm text-coklat-muda">{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-coklat-muda hover:text-coklat-tua rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-terakota" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" 
                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-terakota border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-terakota-hover focus:outline-none focus:ring-2 focus:ring-terakota focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>