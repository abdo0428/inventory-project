@extends('layouts.app')

@section('content')
@php($breadcrumbs = [['title' => __('ui.Dashboard'), 'url' => route('dashboard')]])

<section class="panel mb-4">
    <h1 class="h4 mb-1">{{ __('ui.Dashboard') }}</h1>
    <p class="text-muted mb-0">{{ __('ui.Live overview for products, stock movement, and alerts.') }}</p>
</section>

<div class="metric-grid">
    <article class="metric-card">
        <p class="metric-label">{{ __('ui.Total Products') }}</p>
        <p class="metric-value">{{ number_format($totalProducts) }}</p>
    </article>
    <article class="metric-card">
        <p class="metric-label">{{ __('ui.Total Transactions') }}</p>
        <p class="metric-value">{{ number_format($totalTransactions) }}</p>
    </article>
    <article class="metric-card">
        <p class="metric-label">{{ __('ui.Low Stock Items') }}</p>
        <p class="metric-value">{{ number_format($lowStockProducts) }}</p>
    </article>
    <article class="metric-card">
        <p class="metric-label">{{ __('ui.Recent Transactions') }}</p>
        <p class="metric-value">{{ number_format($recentTransactions->count()) }}</p>
    </article>
</div>

<div class="table-wrap">
    <div class="p-3 border-bottom"><strong>{{ __('ui.Recent Transactions') }}</strong></div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('ui.Product') }}</th>
                    <th>{{ __('ui.Type') }}</th>
                    <th>{{ __('ui.Quantity') }}</th>
                    <th>{{ __('ui.Date & Time') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->product?->name ?? '-' }}</td>
                        <td>
                            <span class="badge-soft {{ $transaction->type === 'IN' ? 'ok' : 'danger' }}">{{ $transaction->type }}</span>
                        </td>
                        <td>{{ number_format($transaction->qty) }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center p-4 text-muted">{{ __('ui.No data available for the selected period') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
