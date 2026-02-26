@extends('layouts.app')

@section('content')
@php
    $breadcrumbs = [['title' => __('ui.Reports'), 'url' => route('reports.index')]];
    $totalProducts = \App\Models\Product::count();
@endphp

<section class="panel mb-4 d-flex justify-content-between align-items-center gap-3 flex-wrap">
    <div>
        <h1 class="h4 mb-1">{{ __('ui.Inventory Reports') }}</h1>
        <p class="text-muted mb-0">{{ __('ui.Analytics and insights for inventory management and stock levels') }}</p>
    </div>
    <form class="d-flex gap-2" method="GET" action="{{ route('reports.index') }}">
        <select name="days" class="form-select">
            @foreach([7, 30, 60, 90, 180, 365] as $d)
                <option value="{{ $d }}" @selected($days == $d)>{{ __('ui.Last') }} {{ $d }} {{ __('ui.days') }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary">{{ __('ui.Apply') }}</button>
    </form>
</section>

<div class="metric-grid">
    <article class="metric-card"><p class="metric-label">{{ __('ui.Low Stock Items') }}</p><p class="metric-value">{{ number_format($lowStock->count()) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Total Products') }}</p><p class="metric-value">{{ number_format($totalProducts) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Stock In (Period)') }}</p><p class="metric-value">{{ number_format($periodStats['in']) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Stock Out (Period)') }}</p><p class="metric-value">{{ number_format($periodStats['out']) }}</p></article>
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="table-wrap h-100">
            <div class="p-3 border-bottom"><strong>{{ __('ui.Top Moving Products') }}</strong></div>
            <div class="table-responsive">
                <table id="topTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ui.Product') }}</th>
                            <th>{{ __('ui.Transactions') }}</th>
                            <th>{{ __('ui.Total Qty') }}</th>
                            <th>{{ __('ui.Stock In') }}</th>
                            <th>{{ __('ui.Stock Out') }}</th>
                            <th>{{ __('ui.Available') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topMoving as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->product?->name }} <small class="text-muted">{{ $row->product?->sku }}</small></td>
                                <td>{{ number_format($row->tx_count) }}</td>
                                <td>{{ number_format($row->total_qty) }}</td>
                                <td class="text-success">{{ number_format($row->in_qty) }}</td>
                                <td class="text-danger">{{ number_format($row->out_qty) }}</td>
                                <td>{{ number_format($row->product?->quantity ?? 0) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center p-4 text-muted">{{ __('ui.No data available for the selected period') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="table-wrap h-100">
            <div class="p-3 border-bottom"><strong>{{ __('ui.Low Stock Alert') }}</strong></div>
            <div class="table-responsive">
                <table id="lowTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('ui.Product') }}</th>
                            <th>{{ __('ui.Current Stock') }}</th>
                            <th>{{ __('ui.Threshold') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStock as $p)
                            <tr>
                                <td>{{ $p->name }} <small class="text-muted">{{ $p->sku }}</small></td>
                                <td><span class="badge-soft danger">{{ $p->quantity }}</span></td>
                                <td>{{ $p->low_stock_threshold }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center p-4 text-success">{{ __('ui.All products are well stocked') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    const topHasColspanRow = $('#topTable tbody td[colspan]').length > 0;
    const lowHasColspanRow = $('#lowTable tbody td[colspan]').length > 0;

    if (!topHasColspanRow) {
        $('#topTable').DataTable({
            paging: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    }

    if (!lowHasColspanRow) {
        $('#lowTable').DataTable({
            paging: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    }
});
</script>
@endpush
