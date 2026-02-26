<x-guest-layout>
    <div class="auth-head">
        <p class="auth-kicker">{{ __('ui.welcome') }}</p>
        <h2 class="auth-title">{{ __('ui.create_account_heading') }}</h2>
        <p class="auth-subtitle">{{ __('ui.create_account_subtitle') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="name" :value="__('ui.name')" />
            <x-text-input id="name" class="block mt-1 w-full auth-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger small" />
        </div>

        <div class="auth-field">
            <x-input-label for="email" :value="__('ui.email')" />
            <x-text-input id="email" class="block mt-1 w-full auth-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
        </div>

        <div class="auth-field">
            <x-input-label for="password" :value="__('ui.password')" />
            <x-text-input id="password" class="block mt-1 w-full auth-input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
        </div>

        <div class="auth-field">
            <x-input-label for="password_confirmation" :value="__('ui.confirm_password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full auth-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger small" />
        </div>

        <div class="auth-actions">
            <a class="auth-link" href="{{ route('login') }}">
                {{ __('ui.have_account') }}
            </a>

            <x-primary-button class="auth-submit">
                {{ __('ui.create_account') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
