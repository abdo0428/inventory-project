<x-guest-layout>
    <div class="auth-head">
        <p class="auth-kicker">{{ __('ui.welcome') }}</p>
        <h2 class="auth-title">{{ __('ui.sign_in_heading') }}</h2>
        <p class="auth-subtitle">{{ __('ui.sign_in_subtitle') }}</p>
    </div>

    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="email" :value="__('ui.email')" />
            <x-text-input id="email" class="block mt-1 w-full auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
        </div>

        <div class="auth-field">
            <x-input-label for="password" :value="__('ui.password')" />
            <x-text-input id="password" class="block mt-1 w-full auth-input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="auth-check">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm">{{ __('ui.remember_me') }}</span>
            </label>
        </div>

        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('ui.forgot_password') }}
                </a>
            @endif

            <x-primary-button class="auth-submit">
                {{ __('ui.log_in') }}
            </x-primary-button>
        </div>
    </form>

    <p class="auth-foot">
        {{ __('ui.no_account') }}
        <a class="auth-link" href="{{ route('register') }}">{{ __('ui.register') }}</a>
    </p>
</x-guest-layout>
