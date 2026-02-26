@extends('layouts.app')

@section('content')
@php($breadcrumbs = [['title' => __('ui.Transactions'), 'url' => route('transactions.index')]])

<section class="panel mb-4 d-flex justify-content-between align-items-center gap-3 flex-wrap">
    <div>
        <h1 class="h4 mb-1">{{ __('ui.Stock Transactions') }}</h1>
        <p class="text-muted mb-0">{{ __('ui.Manage inventory movements with stock in/out operations, quantity tracking, and transaction history') }}</p>
    </div>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTx">{{ __('ui.Add Transaction') }}</button>
</section>

<div class="metric-grid">
    <article class="metric-card"><p class="metric-label">{{ __('ui.Total Transactions') }}</p><p class="metric-value">{{ number_format($transactions->total()) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Stock In') }}</p><p class="metric-value">{{ number_format($transactions->getCollection()->where('type', 'IN')->count()) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Stock Out') }}</p><p class="metric-value">{{ number_format($transactions->getCollection()->where('type', 'OUT')->count()) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Quantity') }}</p><p class="metric-value">{{ number_format($transactions->getCollection()->sum('qty')) }}</p></article>
</div>

<div class="table-wrap mb-4">
    <div class="table-responsive">
        <table id="txTable" class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('ui.Date & Time') }}</th>
                    <th>{{ __('ui.Product') }}</th>
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
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $t->product?->name }} <small class="text-muted">{{ $t->product?->sku }}</small></td>
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
    @if($transactions->hasPages())
        <div class="p-3 border-top">{{ $transactions->links() }}</div>
    @endif
</div>

<div class="modal fade" id="modalTx" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf
                <div class="modal-header"><h5 class="modal-title">{{ __('ui.Add Stock Transaction') }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body row g-3">
                    <div class="col-md-12">
                        <label class="form-label">{{ __('ui.Select Product') }}</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">{{ __('ui.Choose a product...') }}</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->sku }}) - {{ __('ui.Available') }}: {{ $p->quantity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('ui.Transaction Type') }}</label>
                        <select name="type" class="form-select" required>
                            <option value="IN">{{ __('ui.Stock In') }}</option>
                            <option value="OUT">{{ __('ui.Stock Out') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6"><label class="form-label">{{ __('ui.Quantity') }}</label><input type="number" min="1" name="qty" class="form-control" required></div>
                    <div class="col-md-12"><label class="form-label">{{ __('ui.Note (Optional)') }}</label><input name="note" class="form-control"></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('ui.Cancel') }}</button><button class="btn btn-success">{{ __('ui.Record Transaction') }}</button></div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#txTable').DataTable({
        pageLength: 20,
        order: [[0, 'desc']],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>
@endpush
