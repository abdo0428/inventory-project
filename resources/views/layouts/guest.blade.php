<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventory Mini') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell">
    <div class="app-bg"></div>
    <main class="guest-shell">
        <section class="guest-showcase">
            <a href="{{ route('home') }}" class="guest-brand text-decoration-none">
                <span class="brand-mark">IM</span>
                <div>
                    <p class="brand-title mb-0">{{ config('app.name', 'Inventory Mini') }}</p>
                    <p class="brand-subtitle mb-0">{{ __('ui.inventory_platform') }}</p>
                </div>
            </a>

            <p class="guest-caption">{{ __('ui.hero_caption') }}</p>
            <h1 class="guest-title">{{ __('ui.hero_title') }}</h1>
            <p class="guest-note">{{ __('ui.hero_note') }}</p>

            <div class="guest-badges">
                <span class="badge-soft ok">{{ __('ui.feature_realtime') }}</span>
                <span class="badge-soft warn">{{ __('ui.feature_alerts') }}</span>
                <span class="badge-soft danger">{{ __('ui.feature_reports') }}</span>
            </div>

            <div class="lang-switcher guest-lang">
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
        </section>

        <section class="guest-panel-wrap">
            <div class="panel guest-panel">
                {{ $slot }}
            </div>
        </section>
    </main>
</body>
</html>
