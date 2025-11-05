@extends('layouts.app')
@section('style')
    <link rel='stylesheet' href="{{ asset('css/home_main/content_container.css') }}">
@endsection
@section('title', $viewData['title'])

@section('content')
<div class="home_container">
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">LaptopShop Blog</h1>
            <p class="lead text-muted">Nơi chia sẻ <strong>Tech News</strong>, <strong>Reviews</strong> và xu hướng công nghệ mới nhất</p>
        </div>

        <!-- Giới thiệu -->
        <section class="mb-5">
            <h2 class="fw-semibold">Chào mừng đến với LaptopShop Blog</h2>
            <p>
                Chào mừng bạn đến với <strong>LaptopShop Blog</strong> — nơi cập nhật những bài viết, đánh giá và tin tức công nghệ mới nhất.  
                Chúng tôi mang đến góc nhìn thực tế, đáng tin cậy về <em>laptop</em>, phụ kiện và các thiết bị kỹ thuật số.
            </p>
            <p>
                Dù bạn là người dùng phổ thông, sinh viên hay dân công nghệ, Blog của chúng tôi sẽ giúp bạn nắm bắt xu hướng mới, 
                lựa chọn sản phẩm phù hợp và tối ưu trải nghiệm công nghệ mỗi ngày.
            </p>
        </section>

        <!-- Tin nóng 2025 -->
        <section class="mb-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <h2 class="fw-semibold mb-0">Tin nóng 2025</h2>
            <span class="badge bg-danger">Hot</span>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/rog-zephyrus-2025.png') }}" class="card-img-top" alt="ROG Zephyrus 2025">
                <div class="card-body">
                <div class="small text-muted mb-1">Laptop • 2025</div>
                <h5 class="card-title">ROG Zephyrus 2025 — Siêu mỏng nhẹ, hiệu năng khủng</h5>
                <p class="card-text">Trang bị RTX 50 Series, Ryzen AI 9, màn hình 3K 240Hz. Giá dự kiến khoảng 49.9 triệu VNĐ.</p>
                <span class="badge bg-primary">Laptop</span> <span class="badge bg-dark">Gaming</span>
                </div>
            </article>
            </div>

            <div class="col-md-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/thinkpad-x1-carbon-2025.png') }}" class="card-img-top" alt="ThinkPad X1 Carbon 2025">
                <div class="card-body">
                <div class="small text-muted mb-1">Ultrabook • 2025</div>
                <h5 class="card-title">ThinkPad X1 Carbon 2025 — Hiệu năng AI và độ bền huyền thoại</h5>
                <p class="card-text">Sử dụng Intel Core Ultra “Lunar Lake”, NPU AI tích hợp, pin hơn 12 tiếng. Giá từ 42.9 triệu VNĐ.</p>
                <span class="badge bg-success">Business</span> <span class="badge bg-secondary">AI PC</span>
                </div>
            </article>
            </div>

            <div class="col-md-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/macbook-pro-m4-pro.png') }}" class="card-img-top" alt="MacBook Pro M4 Pro (tin đồn)">
                <div class="card-body">
                <div class="small text-muted mb-1">Apple • Tin đồn</div>
                <h5 class="card-title">MacBook Pro M4 Pro — Nâng cấp toàn diện, pin cực trâu</h5>
                <p class="card-text">Hiệu năng vượt trội nhờ chip M4 Pro với Neural Engine thế hệ mới. Dự kiến ra mắt cuối 2025.</p>
                <span class="badge bg-dark">macOS</span> <span class="badge bg-warning text-dark">Rumor</span>
                </div>
            </article>
            </div>

            <div class="col-md-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/acer-swift-go-ai-2025.png') }}" class="card-img-top" alt="Acer Swift Go AI 2025">
                <div class="card-body">
                <div class="small text-muted mb-1">AI PC • 2025</div>
                <h5 class="card-title">Acer Swift Go AI 2025 — Laptop AI giá “mềm”</h5>
                <p class="card-text">Trang bị màn OLED 2.8K, chip NPU on-chip, sạc nhanh 100W. Giá chỉ từ 23.9 triệu VNĐ.</p>
                <span class="badge bg-info text-dark">Student</span> <span class="badge bg-primary">Value</span>
                </div>
            </article>
            </div>

            <div class="col-md-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/lenovo-legion-pro-2025.png') }}" class="card-img-top" alt="Lenovo Legion Pro 2025">
                <div class="card-body">
                <div class="small text-muted mb-1">Gaming • 2025</div>
                <h5 class="card-title">Lenovo Legion Pro 2025 — “Quái vật” RTX 50 Series</h5>
                <p class="card-text">Màn 16” 240Hz, bàn phím cơ mini-switch, pin lớn. Giá từ 54.9 triệu VNĐ.</p>
                <span class="badge bg-dark">RTX 50</span> <span class="badge bg-danger">Performance</span>
                </div>
            </article>
            </div>

            <div class="col-md-6 col-lg-4">
            <article class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/deal-rtx4060-2025.png') }}" class="card-img-top" alt="Deal RTX 4060 2025">
                <div class="card-body">
                <div class="small text-muted mb-1">Deal • Sốc</div>
                <h5 class="card-title">Giảm sốc RTX 4060 Laptop — Giá chỉ 27.9 triệu!</h5>
                <p class="card-text">Hàng chính hãng, bảo hành 24 tháng, số lượng cực giới hạn. Một trong những deal “sốc” nhất đầu năm.</p>
                <span class="badge bg-warning text-dark">Deal</span> <span class="badge bg-success">Hot Price</span>
                </div>
            </article>
            </div>
        </div>
        </section>

        <!-- CPU / GPU / Giá -->
        <section class="mb-5">
        <h2 class="fw-semibold mb-3">2025: CPU / GPU / Giá thành</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/cpu-lunar-lake-ryzen-ai-300.png') }}" class="card-img-top" alt="CPU 2025 Intel Lunar Lake & AMD Ryzen AI 300">
                <div class="card-body">
                <h5 class="card-title">CPU mới nhất</h5>
                <ul>
                    <li><strong>Intel Core Ultra (Lunar Lake):</strong> Hiệu năng cao, NPU tích hợp.</li>
                    <li><strong>AMD Ryzen AI 300:</strong> Đa nhân mạnh, hỗ trợ AI xử lý tại chỗ.</li>
                </ul>
                <p class="small text-muted">Cả hai đều tiết kiệm điện, phù hợp laptop AI 2025.</p>
                </div>
            </div>
            </div>

            <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ asset('img/gpu-rtx-50-laptop.png') }}" class="card-img-top" alt="NVIDIA GeForce RTX 50 Laptop">
                <div class="card-body">
                <h5 class="card-title">GPU mới nhất</h5>
                <p><strong>NVIDIA RTX 50 Laptop</strong> — hiệu suất đồ họa, AI vượt trội. Ray Tracing thế hệ mới, DLSS 4, giảm điện năng đáng kể.</p>
                <p class="small text-muted">GTX chính thức “nghỉ hưu”, nhường chỗ cho RTX toàn dải sản phẩm.</p>
                </div>
            </div>
            </div>

            <div class="col-md-12 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-img-top" alt="Giá laptop 2025">
                <div class="card-body">
                <h5 class="card-title">Giá laptop 2025</h5>
                <ul>
                    <li><strong>AI ultrabook:</strong> 20–35 triệu VNĐ.</li>
                    <li><strong>Gaming RTX 4060–4070:</strong> 27–45 triệu VNĐ.</li>
                    <li><strong>Flagship RTX 50:</strong> từ 50 triệu trở lên.</li>
                </ul>
                <span class="badge bg-warning text-dark">Price Watch</span>
                </div>
            </div>
            </div>
        </div>
        </section>

        <!-- Tin nhanh -->
        <section class="mb-5">
        <h2 class="fw-semibold">Tin nhanh 2025</h2>
        <div class="row g-3">
            <div class="col-md-6">
            <div class="p-3 border rounded-3 bg-light h-100">
                <h6 class="mb-1">Laptop AI dưới 20 triệu</h6>
                <p class="mb-0 small">Một số mẫu mới tích hợp NPU cơ bản bắt đầu xuất hiện — hướng tới sinh viên, dân văn phòng.</p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="p-3 border rounded-3 bg-light h-100">
                <h6 class="mb-1">Màn OLED phổ cập</h6>
                <p class="mb-0 small">Màn 2.8K 120Hz giờ có mặt ở tầm giá 25 triệu — trải nghiệm hình ảnh “đỉnh”.</p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="p-3 border rounded-3 bg-light h-100">
                <h6 class="mb-1">Sạc nhanh 140W phổ biến</h6>
                <p class="mb-0 small">Chuẩn USB-C PD 3.1 cho phép sạc gaming laptop chỉ trong 1 giờ.</p>
            </div>
            </div>
            <div class="col-md-6">
            <div class="p-3 border rounded-3 bg-light h-100">
                <h6 class="mb-1">Giảm giá thế hệ 2024</h6>
                <p class="mb-0 small">RTX 4060/4070 và Ryzen 7000 đang giảm mạnh — cơ hội “ngon – bổ – rẻ”.</p>
            </div>
            </div>
        </div>
        </section>


        <!-- Kết nối -->
        <section class="text-center mt-5">
            <h4>Bạn muốn cập nhật tin tức mới nhất?</h4>
            <p>Đăng ký nhận bản tin hoặc chia sẻ câu chuyện công nghệ của riêng bạn với chúng tôi.</p>
            <p>📧 Email: <strong>blog@laptopshop.com</strong></p>
            <a href="{{ url('/contact') }}" class="btn btn-primary mt-3">Liên hệ ngay</a>
        </section>
    </div>
</div>
@endsection

@section('footer', $viewData['footer'])
