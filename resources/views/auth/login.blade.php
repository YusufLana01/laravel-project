<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <i class="fa-solid fa-chart-line text-4xl text-blue-600 mb-2"></i>
        <h2 class="text-2xl font-bold text-gray-700">Login Sistem CPI</h2>
        <p class="text-sm text-gray-500">Masuk untuk mengelola data mahasiswa</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-600" />
            <x-text-input
                id="email"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                type="email"
                name="email"
                :value="old('email')"
                required autofocus autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-600" />
            <x-text-input
                id="password"
                class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                type="password"
                name="password"
                required autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div>
            <x-primary-button
                class="w-full justify-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:opacity-90">
                <i class="fa-solid fa-right-to-bracket mr-2"></i> Login
            </x-primary-button>
        </div>
        <div class="mt-6 text-center text-sm text-gray-600">
    Belum punya akun?
    <a href="{{ route('register') }}"
       class="text-blue-600 hover:text-indigo-600 font-semibold transition">
        Daftar di sini
    </a>
</div>
    </form>
</x-guest-layout>
