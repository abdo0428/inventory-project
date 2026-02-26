@extends('layouts.app')

@section('content')
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-8">
        <div class="card p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1">التقارير</h5>
                    <div class="text-muted small">الأكثر حركة + تنبيه انخفاض المخزون</div>
                </div>
                <form class="d-flex gap-2" method="GET" action="{{ route('reports.index') }}">
                    <select name="days" class="form-select">
                        @foreach([7, 30, 60, 90, 180, 365] as $d)
                            <option value="{{ $d }}" @selected($days==$d)>آخر {{ $d }} يوم</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">تطبيق</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card p-3">
            <div class="small text-muted">منتجات منخفضة المخزون</div>
            <div class="fs-5 fw-bold">{{ $lowStock->count() }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card p-3">
            <h6 class="mb-3">الأكثر حركة (Top Moving) — آخر {{ $days }} يوم</h6>
            <div class="table-responsive">
                <table id="topTable" class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>عدد العمليات</th>
                        <th>إجمالي الكميات</th>
                        <th>IN</th>
                        <th>OUT</th>
                        <th>المتوفر</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topMoving as $row)
                        <tr>
                            <td>{{ $row->product?->name }} <span class="text-muted">({{ $row->product?->sku }})</span></td>
                            <td class="fw-bold">{{ $row->tx_count }}</td>
                            <td>{{ $row->total_qty }}</td>
                            <td><span class="badge text-bg-success">{{ $row->in_qty }}</span></td>
                            <td><span class="badge text-bg-danger">{{ $row->out_qty }}</span></td>
                            <td>
                                @php($p = $row->product)
                                <span class="badge {{ $p && $p->quantity <= $p->low_stock_threshold ? 'text-bg-warning' : 'text-bg-info' }}">
                                    {{ $p?->quantity }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-muted small">تعتمد الحركة على عدد العمليات وإجمالي الكميات خلال الفترة.</div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card p-3">
            <h6 class="mb-3">تنبيه انخفاض الكمية</h6>

            @if($lowStock->count() === 0)
                <div class="alert alert-success mb-0">لا يوجد منتجات منخفضة حالياً ✅</div>
            @else
                <div class="alert alert-warning">
                    يوجد منتجات تحتاج إعادة تعبئة 🔔
                </div>

                <div class="table-responsive">
                    <table id="lowTable" class="table table-striped align-middle">
                        <thead>
                        <tr>
                            <th>المنتج</th>
                            <th>الكمية</th>
                            <th>الحد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lowStock as $p)
                            <tr>
                                <td>{{ $p->name }} <span class="text-muted">({{ $p->sku }})</span></td>
                                <td><span class="badge text-bg-danger">{{ $p->quantity }}</span></td>
                                <td>{{ $p->low_stock_threshold }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#topTable').DataTable({
        paging: true,
        pageLength: 10,
        order: [[1, 'desc']],
        searching: true,
        language: {
            search: "بحث:",
            lengthMenu: "عرض _MENU_",
            info: "عرض _START_ إلى _END_ من _TOTAL_",
            paginate: { next: "التالي", previous: "السابق" },
            zeroRecords: "لا يوجد نتائج",
        }
    });

    $('#lowTable').DataTable({
        paging: true,
        pageLength: 10,
        order: [[1, 'asc']],
        searching: true,
        language: {
            search: "بحث:",
            lengthMenu: "عرض _MENU_",
            info: "عرض _START_ إلى _END_ من _TOTAL_",
            paginate: { next: "التالي", previous: "السابق" },
            zeroRecords: "لا يوجد نتائج",
        }
    });
});
</script>
@endpush