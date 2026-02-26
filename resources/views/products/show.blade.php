@extends('layouts.app')

@section('content')
@php
    $breadcrumbs = [
        ['title' => __('ui.Products'), 'url' => route('products.index')],
        ['title' => $product->name, 'url' => route('products.show', $product)],
    ];
@endphp

<section class="panel mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1 class="h4 mb-1">{{ $product->name }}</h1>
        <p class="text-muted mb-0">SKU: {{ $product->sku }}</p>
    </div>
    <span class="badge-soft {{ $product->is_low_stock ? 'warn' : 'ok' }}">
        {{ $product->is_low_stock ? __('ui.Low Stock') : __('ui.Normal') }}
    </span>
</section>

<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="panel h-100">
            <h5 class="mb-3">{{ __('ui.Product') }}</h5>
            <dl class="row mb-0">
                <dt class="col-5">{{ __('ui.SKU') }}</dt><dd class="col-7">{{ $product->sku }}</dd>
                <dt class="col-5">{{ __('ui.Product Name') }}</dt><dd class="col-7">{{ $product->name }}</dd>
                <dt class="col-5">{{ __('ui.Quantity') }}</dt><dd class="col-7">{{ $product->quantity }}</dd>
                <dt class="col-5">{{ __('ui.Low Stock Threshold') }}</dt><dd class="col-7">{{ $product->low_stock_threshold }}</dd>
                <dt class="col-5">{{ __('ui.Description') }}</dt><dd class="col-7">{{ $product->description ?: '-' }}</dd>
            </dl>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="table-wrap">
            <div class="p-3 border-bottom"><strong>{{ __('ui.Transaction History') }}</strong></div>
            <div class="table-responsive">
                <table id="txTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('ui.Date & Time') }}</th>
                            <th>{{ __('ui.Type') }}</th>
                            <th>{{ __('ui.Quantity') }}</th>
                            <th>{{ __('ui.Before') }}</th>
                            <th>{{ __('ui.After') }}</th>
                            <th>{{ __('ui.Note') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $t)
                            <tr>
                                <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                                <td><span class="badge-soft {{ $t->type === 'IN' ? 'ok' : 'danger' }}">{{ $t->type }}</span></td>
                                <td>{{ number_format($t->qty) }}</td>
                                <td>{{ number_format($t->before_qty) }}</td>
                                <td>{{ number_format($t->after_qty) }}</td>
                                <td>{{ $t->note ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3 border-top">{{ $transactions->links() }}</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#txTable').DataTable({
        paging: false,
        searching: true,
        info: false,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>
@endpush
