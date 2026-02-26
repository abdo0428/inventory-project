@extends('layouts.app')

@section('content')
<div class="row g-3 mb-3">
    <div class="col-12 col-lg-8">
        <div class="card p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1">المنتجات</h5>
                    <div class="text-muted small">إدارة المنتجات والكميات وحدود التنبيه</div>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    + إضافة منتج
                </button>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card p-3">
            <div class="small text-muted">تنبيه انخفاض المخزون</div>
            <div class="fs-5 fw-bold">
                {{ $products->where(fn($p)=> $p->quantity <= $p->low_stock_threshold)->count() }}
                <span class="text-muted fs-6">منتج منخفض</span>
            </div>
        </div>
    </div>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table id="productsTable" class="table table-striped table-hover align-middle">
            <thead>
            <tr>
                <th>#</th>
                <th>SKU</th>
                <th>الاسم</th>
                <th>الكمية</th>
                <th>حد التنبيه</th>
                <th>الحالة</th>
                <th class="text-center">إجراءات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td class="fw-semibold">{{ $p->sku }}</td>
                    <td>{{ $p->name }}</td>
                    <td>
                        <span class="badge {{ $p->quantity <= $p->low_stock_threshold ? 'text-bg-danger' : 'text-bg-success' }}">
                            {{ $p->quantity }}
                        </span>
                    </td>
                    <td>{{ $p->low_stock_threshold }}</td>
                    <td>
                        @if($p->quantity <= $p->low_stock_threshold)
                            <span class="badge text-bg-warning">منخفض</span>
                        @else
                            <span class="badge text-bg-info">طبيعي</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEdit"
                                data-id="{{ $p->id }}"
                                data-sku="{{ $p->sku }}"
                                data-name="{{ $p->name }}"
                                data-description="{{ $p->description }}"
                                data-low="{{ $p->low_stock_threshold }}"
                            >تعديل</button>

                            <button class="btn btn-outline-danger btn-sm btn-delete"
                                data-url="{{ route('products.destroy', $p) }}"
                                data-name="{{ $p->name }}"
                            >حذف</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="modalCreate" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:16px">
      <div class="modal-header">
        <h5 class="modal-title">إضافة منتج</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">SKU</label>
                    <input name="sku" class="form-control" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">اسم المنتج</label>
                    <input name="name" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">وصف</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">الكمية الحالية</label>
                    <input name="quantity" type="number" min="0" class="form-control" value="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">حد التنبيه (Low Stock)</label>
                    <input name="low_stock_threshold" type="number" min="0" class="form-control" value="5" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">إلغاء</button>
          <button class="btn btn-primary" type="submit">حفظ</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:16px">
      <div class="modal-header">
        <h5 class="modal-title">تعديل منتج</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">SKU</label>
                    <input id="editSku" name="sku" class="form-control" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label">اسم المنتج</label>
                    <input id="editName" name="name" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">وصف</label>
                    <textarea id="editDescription" name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">حد التنبيه (Low Stock)</label>
                    <input id="editLow" name="low_stock_threshold" type="number" min="0" class="form-control" required>
                    <div class="form-text">ملاحظة: تعديل “الكمية” يتم من صفحة العمليات (IN/OUT).</div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-light" type="button" data-bs-dismiss="modal">إلغاء</button>
          <button class="btn btn-primary" type="submit">تحديث</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete form -->
<form id="deleteForm" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
$(function () {
    $('#productsTable').DataTable({
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

    const editModal = document.getElementById('modalEdit');
    editModal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const id = btn.getAttribute('data-id');

        $('#editSku').val(btn.getAttribute('data-sku'));
        $('#editName').val(btn.getAttribute('data-name'));
        $('#editDescription').val(btn.getAttribute('data-description') ?? '');
        $('#editLow').val(btn.getAttribute('data-low'));

        $('#editForm').attr('action', `/products/${id}`);
    });

    $('.btn-delete').on('click', function () {
        const url = $(this).data('url');
        const name = $(this).data('name');

        Swal.fire({
            icon: 'warning',
            title: 'تأكيد الحذف',
            text: `هل تريد حذف المنتج: ${name} ؟`,
            showCancelButton: true,
            confirmButtonText: 'نعم احذف',
            cancelButtonText: 'إلغاء'
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