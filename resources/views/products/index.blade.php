@extends('layouts.app')

@section('content')
@php
    $breadcrumbs = [
        ['title' => __('ui.Products'), 'url' => route('products.index')],
    ];
    $lowCount = $products->getCollection()->filter(fn($p) => $p->quantity <= $p->low_stock_threshold)->count();
@endphp

<section class="panel mb-4 d-flex justify-content-between align-items-center gap-3 flex-wrap">
    <div>
        <h1 class="h4 mb-1">{{ __('ui.Products') }}</h1>
        <p class="text-muted mb-0">{{ __('ui.Manage products, quantities and alert thresholds') }}</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">{{ __('ui.Add New Product') }}</button>
</section>

<div class="metric-grid">
    <article class="metric-card"><p class="metric-label">{{ __('ui.Total Products') }}</p><p class="metric-value">{{ number_format($products->total()) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Low Stock Items') }}</p><p class="metric-value">{{ number_format($lowCount) }}</p></article>
    <article class="metric-card"><p class="metric-label">{{ __('ui.Out of Stock') }}</p><p class="metric-value">{{ number_format($products->getCollection()->where('quantity', 0)->count()) }}</p></article>
</div>

<section class="panel mb-4">
    <form method="GET" class="row g-3 align-items-end">
        <div class="col-md-8">
            <label class="form-label">{{ __('ui.Search') }}</label>
            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="{{ __('ui.Search by name or SKU...') }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary">{{ __('ui.Apply') }}</button>
            @if(request('search'))
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">{{ __('ui.Cancel') }}</a>
            @endif
        </div>
    </form>
</section>

<div class="table-wrap">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="productsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('ui.SKU') }}</th>
                    <th>{{ __('ui.Product Name') }}</th>
                    <th>{{ __('ui.Quantity') }}</th>
                    <th>{{ __('ui.Low Stock Threshold') }}</th>
                    <th>{{ __('ui.Status') }}</th>
                    <th>{{ __('ui.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->sku }}</td>
                        <td><a href="{{ route('products.show', $p) }}">{{ $p->name }}</a></td>
                        <td>{{ $p->quantity }}</td>
                        <td>{{ $p->low_stock_threshold }}</td>
                        <td>
                            <span class="badge-soft {{ $p->quantity <= $p->low_stock_threshold ? 'warn' : 'ok' }}">
                                {{ $p->quantity <= $p->low_stock_threshold ? __('ui.Low Stock') : __('ui.Normal') }}
                            </span>
                        </td>
                        <td class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                data-id="{{ $p->id }}"
                                data-sku="{{ $p->sku }}"
                                data-name="{{ $p->name }}"
                                data-description="{{ $p->description }}"
                                data-low="{{ $p->low_stock_threshold }}">{{ __('ui.Edit Product') }}</button>
                            <button class="btn btn-sm btn-outline-danger btn-delete" data-url="{{ route('products.destroy', $p) }}" data-name="{{ $p->name }}">{{ __('ui.Delete') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="p-3 border-top">{{ $products->links() }}</div>
    @endif
</div>

<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="modal-header"><h5 class="modal-title">{{ __('ui.Add New Product') }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label class="form-label">{{ __('ui.SKU') }}</label><input name="sku" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">{{ __('ui.Product Name') }}</label><input name="name" class="form-control" required></div>
                    <div class="col-12"><label class="form-label">{{ __('ui.Description') }}</label><textarea name="description" rows="2" class="form-control"></textarea></div>
                    <div class="col-md-6"><label class="form-label">{{ __('ui.Current Quantity') }}</label><input type="number" min="0" name="quantity" value="0" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">{{ __('ui.Low Stock Threshold') }}</label><input type="number" min="0" name="low_stock_threshold" value="5" class="form-control" required></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('ui.Cancel') }}</button><button class="btn btn-primary">{{ __('ui.Create Product') }}</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header"><h5 class="modal-title">{{ __('ui.Edit Product') }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body row g-3">
                    <div class="col-md-6"><label class="form-label">{{ __('ui.SKU') }}</label><input id="editSku" name="sku" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">{{ __('ui.Product Name') }}</label><input id="editName" name="name" class="form-control" required></div>
                    <div class="col-12"><label class="form-label">{{ __('ui.Description') }}</label><textarea id="editDescription" name="description" rows="2" class="form-control"></textarea></div>
                    <div class="col-md-6"><label class="form-label">{{ __('ui.Low Stock Threshold') }}</label><input id="editLow" name="low_stock_threshold" type="number" min="0" class="form-control" required></div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('ui.Cancel') }}</button><button class="btn btn-primary">{{ __('ui.Update Product') }}</button></div>
            </form>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
$(function () {
    const localePrefix = @json('/' . app()->getLocale());

    $('#productsTable').DataTable({
        pageLength: 20,
        order: [[0, 'desc']],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    document.getElementById('modalEdit').addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        if (!btn) return;
        const id = btn.getAttribute('data-id');
        $('#editSku').val(btn.getAttribute('data-sku'));
        $('#editName').val(btn.getAttribute('data-name'));
        $('#editDescription').val(btn.getAttribute('data-description') ?? '');
        $('#editLow').val(btn.getAttribute('data-low'));
        $('#editForm').attr('action', `${localePrefix}/products/${id}`);
    });

    $('.btn-delete').on('click', function () {
        const url = $(this).data('url');
        const name = $(this).data('name');
        Swal.fire({
            icon: 'warning',
            title: 'Delete product?',
            text: name,
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = url;
                form.submit();
            }
        });
    });
});
</script>
@endpush
