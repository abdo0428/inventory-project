<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventory Mini') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-shell">
    <div class="app-bg"></div>

    <div class="app-frame">
        <aside class="app-sidebar">
            <div class="app-brand-wrap">
                <a href="{{ route('dashboard') }}" class="app-brand text-decoration-none">
                    <span class="brand-mark">IM</span>
                    <div>
                        <p class="brand-title">{{ config('app.name', 'Inventory Mini') }}</p>
                        <p class="brand-subtitle">{{ __('ui.inventory_management') }}</p>
                    </div>
                </a>
            </div>

            <nav class="app-nav">
                <a href="{{ route('dashboard') }}" class="app-nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">{{ __('ui.dashboard') }}</a>
                <a href="{{ route('products.index') }}" class="app-nav-link {{ request()->routeIs('products.*') ? 'is-active' : '' }}">{{ __('ui.products') }}</a>
                <a href="{{ route('transactions.index') }}" class="app-nav-link {{ request()->routeIs('transactions.*') ? 'is-active' : '' }}">{{ __('ui.transactions') }}</a>
                <a href="{{ route('reports.index') }}" class="app-nav-link {{ request()->routeIs('reports.*') ? 'is-active' : '' }}">{{ __('ui.reports') }}</a>
                <a href="{{ route('notifications.index') }}" class="app-nav-link {{ request()->routeIs('notifications.*') ? 'is-active' : '' }}">{{ __('ui.notifications') }}</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('settings.index') }}" class="app-nav-link {{ request()->routeIs('settings.*') ? 'is-active' : '' }}">{{ __('ui.settings') }}</a>
                    @endif
                @endauth
            </nav>

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
        </aside>

        <div class="app-main">
            @include('layouts.navigation')

            <main class="app-content">
                @isset($header)
                    <section class="page-header">{{ $header }}</section>
                @endisset

                @if(isset($breadcrumbs) && is_array($breadcrumbs))
                    <x-breadcrumbs :items="$breadcrumbs" />
                @endif

                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if(session('success')) toastr.success(@json(session('success'))); @endif
        @if(session('error')) toastr.error(@json(session('error'))); @endif
        @if(session('warning')) toastr.warning(@json(session('warning'))); @endif
        @if(session('info')) toastr.info(@json(session('info'))); @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        @endif
    </script>

    @stack('scripts')
</body>
</html>
