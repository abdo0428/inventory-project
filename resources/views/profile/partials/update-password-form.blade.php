<section>
    <header class="profile-section-head">
        <h2 class="text-lg font-medium text-gray-900 mb-1">
            {{ __('ui.update_password') }}
        </h2>

        <p class="text-sm text-gray-600 mb-0">
            {{ __('ui.update_password_help') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('put')

        <div class="auth-field">
            <x-input-label for="update_password_current_password" :value="__('ui.current_password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full auth-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="auth-field">
            <x-input-label for="update_password_password" :value="__('ui.new_password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full auth-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="auth-field">
            <x-input-label for="update_password_password_confirmation" :value="__('ui.confirm_password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full auth-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('ui.save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('ui.saved') }}</p>
            @endif
        </div>
    </form>
</section>
