<nav class="topbar">
    <div>
        <p class="topbar-title">{{ __('ui.welcome') }}, {{ Auth::user()->name }}</p>
        <p class="topbar-subtitle">{{ Auth::user()->email }}</p>
    </div>

    <div class="topbar-actions">
        <a href="{{ route('profile.edit') }}" class="topbar-link">{{ __('ui.profile') }}</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="topbar-btn">{{ __('ui.logout') }}</button>
        </form>
    </div>
</nav>
