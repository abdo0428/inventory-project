<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inventory Mini') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell">
    <div class="app-bg"></div>
    <main class="welcome-shell">
        <section class="welcome-panel">
            <div class="welcome-topbar">
                <a href="{{ route('home') }}" class="guest-brand text-decoration-none">
                    <span class="brand-mark">IM</span>
                    <div>
                        <p class="brand-title mb-0">{{ config('app.name', 'Inventory Mini') }}</p>
                        <p class="brand-subtitle mb-0">{{ __('ui.inventory_platform') }}</p>
                    </div>
                </a>

                <div class="lang-switcher">
                    @php
                        $segments = request()->segments();
                        if (in_array($segments[0] ?? null, ['en', 'ar', 'tr'], true)) {
                            array_shift($segments);
                        }
                        $path = count($segments) ? '/' . implode('/', $segments) : '';
                        $query = request()->getQueryString();
                        $suffix = $path . ($query ? '?' . $query : '');
                    @endphp
                    <a href="{{ url('/en' . $suffix) }}" class="lang-btn {{ app()->getLocale() === 'en' ? 'is-active' : '' }}">EN</a>
                    <a href="{{ url('/ar' . $suffix) }}" class="lang-btn {{ app()->getLocale() === 'ar' ? 'is-active' : '' }}">AR</a>
                    <a href="{{ url('/tr' . $suffix) }}" class="lang-btn {{ app()->getLocale() === 'tr' ? 'is-active' : '' }}">TR</a>
                </div>
            </div>

            <div class="welcome-grid">
                <article class="welcome-copy">
                    <p class="welcome-kicker">{{ __('ui.hero_caption') }}</p>
                    <h1 class="welcome-title">{{ __('ui.hero_title') }}</h1>
                    <p class="welcome-subtitle">{{ __('ui.track_stock') }}</p>

                    <div class="welcome-badges">
                        <span class="badge-soft ok">{{ __('ui.feature_realtime') }}</span>
                        <span class="badge-soft warn">{{ __('ui.feature_alerts') }}</span>
                        <span class="badge-soft danger">{{ __('ui.feature_reports') }}</span>
                    </div>

                    @auth
                        <a class="btn btn-primary" href="{{ route('dashboard') }}">{{ __('ui.dashboard') }}</a>
                    @else
                        <div class="d-flex flex-wrap gap-2">
                            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('ui.log_in') }}</a>
                            <a class="btn btn-outline-primary" href="{{ route('register') }}">{{ __('ui.register') }}</a>
                        </div>
                    @endauth
                </article>

                <div class="welcome-stats">
                    <article class="welcome-stat-card">
                        <p class="stat-title">{{ __('ui.products') }}</p>
                        <p class="stat-value">320+</p>
                    </article>
                    <article class="welcome-stat-card">
                        <p class="stat-title">{{ __('ui.transactions') }}</p>
                        <p class="stat-value">1.2k</p>
                    </article>
                    <article class="welcome-stat-card">
                        <p class="stat-title">{{ __('ui.reports') }}</p>
                        <p class="stat-value">24/7</p>
                    </article>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
