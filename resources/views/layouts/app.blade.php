<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Mini</title>

    <!-- Bootstrap 5 (RTL) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background:#f7f7fb; }
        .card { border:0; border-radius:16px; box-shadow: 0 8px 24px rgba(0,0,0,.06); }
        .btn { border-radius:12px; }
        .badge { border-radius:999px; }
        .navbar { box-shadow: 0 4px 18px rgba(0,0,0,.06); }
        table.dataTable td, table.dataTable th { vertical-align: middle; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('products.index') }}">Inventory Mini</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">المنتجات</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}">العمليات</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">التقارير</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({ icon:'success', title:'تم!', text:@json(session('success')), timer:1800, showConfirmButton:false });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon:'error',
                    title:'خطأ في الإدخال',
                    html: `<ul class="text-start mb-0">
                        {!! implode('', $errors->all('<li>:message</li>')) !!}
                    </ul>`,
                });
            });
        </script>
    @endif

    @yield('content')
</main>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')
</body>
</html>