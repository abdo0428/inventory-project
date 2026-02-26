@extends('layouts.app')

@section('content')
@php($breadcrumbs = [['title' => __('ui.Settings'), 'url' => route('settings.index')]])

<section class="panel mb-4">
    <h1 class="h4 mb-1">{{ __('ui.System Settings') }}</h1>
    <p class="text-muted mb-0">{{ __('ui.Configure application preferences and system behavior') }}</p>
</section>

<section class="panel">
    <form method="POST" action="{{ route('settings.update') }}" class="row g-4">
        @csrf
        @method('PUT')

        <div class="col-md-6">
            <label class="form-label">{{ __('ui.Application Name') }}</label>
            <input name="app_name" class="form-control" value="{{ $settings['app_name'] }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ __('ui.Default Low Stock Threshold') }}</label>
            <input type="number" min="0" name="default_low_stock_threshold" class="form-control" value="{{ $settings['default_low_stock_threshold'] }}" required>
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cache_reports" id="cache_reports" value="1" @checked($settings['cache_reports'])>
                <label class="form-check-label" for="cache_reports">{{ __('ui.Enable Report Caching') }}</label>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-light">{{ __('ui.Cancel') }}</a>
            <button class="btn btn-primary">{{ __('ui.Save Settings') }}</button>
        </div>
    </form>
</section>
@endsection
