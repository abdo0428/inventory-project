@extends('layouts.app')

@section('content')
<div class="card p-3 mb-3">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h5 class="mb-1">عمليات المخزون (Stock In/Out)</h5>
            <div class="text-muted small">إضافة/سحب مخزون مع منع السحب الزائد وتسجيل قبل/بعد</div>
        </div>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTx">
            + إضافة عملية
        </button>
    </div>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table id="txTable" class="table table-striped table-hover align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>التاريخ</th>
                <th>المنتج</th>
                <th>النوع</th>
                <th>الكمية</th>
                <th>قبل</th>
                <th>بعد</th>
                <th>ملاحظة</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $t->product?->name }} <span class="text-muted">({{ $t->product?->sku }})</span></td>
                    <td>
                        @if($t->type === 'IN')
                            <span class="badge text-bg-success">IN</span>
                        @else
                            <span class="badge text-bg-danger">OUT</span>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $t->qty }}</td>
                    <td>{{ $t->before_qty }}</td>
                    <td>{{ $t->after_qty }}</td>
                    <td class="text-muted">{{ $t->note }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tx Modal -->
<div class="modal fade" id="modalTx" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:16px">
      <div class="modal-header">
        <h5 class="modal-title">إضافة عملية مخزون</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" action="{{ route('transactions.store') }}">
        @csrf
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">المنتج</label>
                    <select name="product_id" class="form-select" required>
                        <option value="" disabled selected>اختر منتج...</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->name }} ({{ $p->sku }}) — المتوفر: {{ $p->quantity }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">النوع</label>
                    <select name="type" class="form-select" required>
                        <option value="IN">Stock IN</option>
                        <option value="OUT">Stock OUT</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">الكمية</label>
                    <input name="qty" type="number" min="1" class="form-control" required>
                </div>

                <div class="col-md-8">
                    <label class="form-label">ملاحظة</label>
                    <input name="note" class="form-control" placeholder="سبب العملية / رقم فاتورة ...">
                </div>

                <div class="col-12">
                    <div class="alert alert-info mb-0">
                        ملاحظة: عند اختيار <b>OUT</b> سيتم منع سحب كمية أكبر من المتوفر.
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">إلغاء</button>
          <button class="btn btn-success" type="submit">تسجيل العملية</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#txTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']],
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