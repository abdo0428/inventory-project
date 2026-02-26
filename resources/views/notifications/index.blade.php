@extends('layouts.app')

@section('content')
@php($breadcrumbs = [['title' => __('ui.Notifications'), 'url' => route('notifications.index')]])

<section class="panel mb-4">
    <h1 class="h4 mb-1">{{ __('ui.Notifications & Alerts') }}</h1>
    <p class="text-muted mb-0">{{ __('ui.System alerts, low stock warnings, and inventory notifications') }}</p>
</section>

@if($lowStockProducts->isEmpty())
    <section class="panel text-center py-5">
        <h4 class="text-success">{{ __('ui.All Products Are Well Stocked') }}</h4>
        <p class="text-muted">{{ __('ui.No products currently need restocking. Your inventory levels are healthy!') }}</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('ui.View All Products') }}</a>
    </section>
@else
    <div class="alert alert-warning">
        {{ __('ui.You have') }} {{ $lowStockProducts->count() }} {{ __('ui.product(s) that need immediate restocking attention.') }}
    </div>

    <div class="row g-4">
        @foreach($lowStockProducts as $product)
            <div class="col-lg-4">
                <article class="panel h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="mb-1">{{ $product->name }}</h5>
                            <p class="text-muted mb-0">{{ $product->sku }}</p>
                        </div>
                        <span class="badge-soft warn">{{ __('ui.Low Stock') }}</span>
                    </div>
                    <p class="mb-2">{{ __('ui.Current Stock') }}: <strong>{{ $product->quantity }}</strong></p>
                    <p class="mb-3">{{ __('ui.Threshold') }}: <strong>{{ $product->low_stock_threshold }}</strong></p>
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('products.show', $product) }}">{{ __('ui.View Details') }}</a>
                        <a class="btn btn-success btn-sm" href="{{ route('transactions.index') }}">{{ __('ui.Add Transaction') }}</a>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endif
@endsection
