<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><!-- Mã hóa ký tự -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- Responsive -->
    <title>@yield('title', 'My Website')</title><!-- Tiêu đề mặc định, cho phép override -->

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (icon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- CSS tuỳ biến -->
    <link rel="stylesheet" href="{{ asset('css/home_layout/nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home_layout/search_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home_layout/background.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home_layout/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home_layout/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home_main/content_container.css') }}">

    @yield('style')<!-- Cho phép chèn thêm CSS riêng của từng view -->
</head>
    @php
        // Xác định các route KHÔNG hiển thị sidebar
        $hideSidebar = request()->routeIs(
            'home.blog',        // Blog
            'home.about',       // About
            'home.contact',     // Contact
            'cart.index',       // Cart
            'myaccount.orders', // My Orders
            'login',            // Login
            'register'          // Register
        );
    @endphp
<body class="d-flex flex-column min-vh-100 background {{ $hideSidebar ? 'no-sidebar' : '' }}"><!-- Dàn trang full-height; thêm class no-sidebar khi cần -->

    <!-- ===== HEADER / NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm custom_navbar header"><!-- Navbar dính trên cùng -->
        <div class="container">
            <!-- Logo dẫn về trang chủ -->
            <a class="navbar-brand d-flex align-items-center" href="{{ Route('home.main') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" height="55" class="me-2">
            </a>
            
            <!-- Ô tìm kiếm chiếm không gian giữa -->
            <div class="flex-grow-1 mx-3">
                <form action="{{ route('products.search') }}" method="GET" class="d-flex">
                    <input 
                        class="form-control me-2" 
                        type="search" 
                        name="query" 
                        placeholder="Tìm kiếm sản phẩm..." 
                        aria-label="Search"
                        list="datalistOptions"   
                        value="{{ request('query') }}"> <!-- Giữ lại từ khoá khi reload -->
                    
                </form>
            </div>              
            
            <!-- Menu phải -->
            <div class="collapse navbar-collapse d-flex" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- Link public -->
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home.main') }}">Home</a><!-- Active khi ở route home -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->is('blog*') ? 'active' : '' }}"
                           href="{{ route('home.blog') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->is('about*') ? 'active' : '' }}"
                           href="{{ route('home.about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->is('contact*') ? 'active' : '' }}"
                           href="{{ route('home.contact') }}">Contact</a>
                    </li>

                    @guest
                    <!-- Khi CHƯA đăng nhập -->
                    {{-- Link Login với icon --}}
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->is('login') ? 'active' : '' }}"
                           href="{{ route('login') }}" title="Login">
                            <i class="fa-solid fa-right-to-bracket"></i><!-- Icon đăng nhập -->
                        </a>
                    </li>
                    @else
                    <!-- Khi ĐÃ đăng nhập -->
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->is('order*') ? 'active' : '' }}"
                           href="{{ route('myaccount.orders') }}">My Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover_link {{ request()->routeIs('cart.index') ? 'active' : '' }}"
                           href="{{ route('cart.index') }}">
                            <i class="fa-solid fa-cart-shopping"></i><!-- Icon giỏ hàng -->
                        </a>
                    </li>
                    {{-- Logout: dùng form POST theo chuẩn Laravel --}}
                    <li class="nav-item">
                        <form id="logout" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <!-- Dùng link giả để submit form -->
                            <a role="button" class="nav-link hover_link" onclick="document.getElementById('logout').submit();" title="Logout">
                                <i class="fa-solid fa-right-from-bracket"></i><!-- Icon đăng xuất -->
                            </a>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== MAIN CONTENT ===== -->
    @yield('sidebar')<!-- Hook nếu trang con muốn tự render sidebar riêng -->

    <main class="flex-grow-1 py-4"><!-- Khu nội dung chính -->
        <div class="container-fluid">
            <div class="row">

                {{-- Sidebar: chỉ hiển thị khi KHÔNG thuộc các trang ẩn --}}
                @unless($hideSidebar)
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar p-3 border-end">
                        {{-- Nhúng phần sidebar dùng chung --}}
                        @include('partials.sidebar')
                    </nav>
                @endunless

                {{-- Cột nội dung: FULL khi ẩn sidebar, ngược lại thì chiếm phần còn lại --}}
                {{-- 
                    Gợi ý: class bên dưới có vẻ sai chính tả "col-md-5col-lg-10".
                    Không sửa logic theo yêu cầu, chỉ lưu ý:
                    - Có thể bạn muốn: {{ $hideSidebar ? 'col-12 px-4' : 'col-md-9 col-lg-10 px-4' }}
                --}}
                <div class='col-md-5col-lg-10 px-4'>
                    @yield('content')<!-- Nội dung động của từng trang -->
                </div>
            </div>
        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="text-black py-4 footer">
        <div class="container">
            <div class="footer-inner">
                <div class="row align-items-center">
                    <!-- Cột trái: thông tin thương hiệu -->
                    <div class="col-md-6 text-md-start text-center">
                        <!-- col-md-6: chia đều 50%; text-md-start: canh trái trên md; text-center: canh giữa trên mobile -->
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" width="40" class="mb-2 d-block mx-md-0 mx-auto">
                        <h3 class="generic">LaptopShop</h3>
                        <p class="generic">Your one-stop shop for all laptop needs.</p>
                        <p class="mb-0">
                            @yield('footer', '© 2024 My Website. All rights reserved.')<!-- Cho phép override dòng bản quyền -->
                        </p>
                    </div>

                    <!-- Cột phải: liên hệ + mạng xã hội -->
                    <div class="col-md-6 text-md-end text-center">
                        <!-- col-md-6: 50%; text-md-end: canh phải trên md; text-center: canh giữa mobile -->
                        <h5>Contact Us</h5>
                        <p class="mb-1">
                            Email:
                            <a href="mailto:info@mywebsite.com" class="text-warning text-decoration-none" style="color: #b71c1c; font-weight: bold; text-decoration: none;">
                                info@mywebsite.com
                            </a>
                        </p>
                        <div class="mt-2">
                            <a href="#" class="text-white me-3"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="text-white"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- ===== JS ===== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script><!-- Bundle gồm Popper -->
</body>
</html>
