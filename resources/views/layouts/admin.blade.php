<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"><!-- Mã hoá ký tự -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Responsive -->
    <title>@yield('title', 'Admin Dashboard')</title><!-- Tiêu đề mặc định, view con có thể override -->

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- CSS tuỳ chọn (có thể bỏ nếu dùng thuần Bootstrap) --}}
    <link href="{{ asset('css/admin/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" />

    @stack('styles')<!-- Cho phép view con push thêm CSS -->
</head>

<body class="bg-light">
    <div class="d-flex min-vh-100"><!-- Bố cục 2 cột: sidebar + nội dung; cao tối thiểu = chiều cao viewport -->

        {{-- Sidebar --}}
        <aside class="bg-dark text-white p-3 d-flex flex-column" style="width: 250px;">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-uppercase border-bottom pb-2">Admin Panel</h4>
            </div>

            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <!-- ⚠️ route 'admin.dashbroad' có thể là 'dashboard'? (ghi chú, không đổi logic) -->
                    <a href="{{ route('admin.dashbroad') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.users.index') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.products') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-bag-check me-2"></i> Products
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-box-seam me-2"></i> Categories
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <!-- ⚠️ route 'admin.oders.index' có thể là 'orders'? (ghi chú, không đổi logic) -->
                    <a href="{{ route('admin.oders.index') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-box-seam me-2"></i> Oders
                    </a>
                </li>

                <li class="nav-item mt-auto"><!-- Đẩy nút logout xuống cuối sidebar -->
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        {{-- Khu vực nội dung chính --}}
        <div class="flex-grow-1 d-flex flex-column">
            {{-- Top Navbar cố định trên phần nội dung --}}
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <div class="container-fluid d-flex justify-content-end align-items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Admin logo" class="rounded-circle me-3" width="40" height="40"><!-- Avatar/logo admin -->
                    <span class="fw-semibold text-dark">Admin</span>
                </div>
            </nav>

            {{-- Nội dung trang động --}}
            <main class="flex-grow-1 p-4">
                @yield('content')<!-- View con render tại đây -->
            </main>

            {{-- Footer --}}
            <footer class="bg-dark text-center text-white py-3 mt-auto">
                <small>
                    &copy; {{ date('Y') }} -
                    <a href="https://twitter.com/danielgarax" target="_blank" rel="noopener"
                       class="text-reset fw-bold text-decoration-none">
                        Daniel Correa
                    </a>
                </small>
            </footer>
        </div>
    </div>

    {{-- Bootstrap JS (bundle kèm Popper) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')<!-- Cho phép view con push thêm JS -->
</body>
</html>
