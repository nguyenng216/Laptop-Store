@extends('layouts.app')
@section('style')
    <link rel='stylesheet' href="{{ asset('css/home_main/content_container.css') }}">
@endsection
@section('title', $viewData['title'])

@section('content')
 <div class="home_container">
   <div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Về Chúng Tôi</h1>
        <p class="lead text-muted">LaptopStore – Nơi công nghệ gặp đam mê</p>
    </div>

    <!-- Giới thiệu -->
    <section class="mb-5">
        <h2 class="fw-semibold">Giới thiệu chung</h2>
        <p>
            LaptopStore được thành lập với sứ mệnh mang đến cho khách hàng những sản phẩm công nghệ chính hãng,
            chất lượng cao với mức giá hợp lý nhất. Chúng tôi chuyên cung cấp laptop, phụ kiện và các thiết bị
            điện tử từ những thương hiệu hàng đầu như Apple, Dell, Asus, HP, Lenovo và nhiều hãng khác.
        </p>
        <p>
            Với đội ngũ kỹ thuật viên giàu kinh nghiệm, LaptopStore không chỉ là nơi mua sắm đáng tin cậy
            mà còn là trung tâm hỗ trợ kỹ thuật tận tâm dành cho người yêu công nghệ.
        </p>
    </section>

    <!-- Tầm nhìn & sứ mệnh -->
    <section class="mb-5">
        <h2 class="fw-semibold">Tầm nhìn & Sứ mệnh</h2>
        <ul>
            <li><strong>Tầm nhìn:</strong> Trở thành hệ thống bán lẻ laptop uy tín hàng đầu tại Việt Nam.</li>
            <li><strong>Sứ mệnh:</strong> Mang công nghệ hiện đại đến gần hơn với mọi người, tạo ra trải nghiệm mua sắm tiện lợi và đáng tin cậy.</li>
            <li><strong>Giá trị cốt lõi:</strong> Chất lượng - Uy tín - Dịch vụ - Đổi mới.</li>
        </ul>
    </section>

    <!-- Dịch vụ -->
    <section class="mb-5">
        <h2 class="fw-semibold">Dịch vụ của chúng tôi</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Bán lẻ & Online</h5>
                        <p class="card-text">
                            Mua sắm dễ dàng tại cửa hàng hoặc trực tuyến với giao hàng nhanh chóng và bảo hành chính hãng.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Bảo hành & Sửa chữa</h5>
                        <p class="card-text">
                            Trung tâm kỹ thuật được chứng nhận, hỗ trợ bảo hành và sửa chữa mọi thương hiệu laptop phổ biến.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Tư vấn & Hỗ trợ</h5>
                        <p class="card-text">
                            Đội ngũ tư vấn viên sẵn sàng hỗ trợ 24/7 qua hotline, email và mạng xã hội.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Đội ngũ -->
    <section class="mb-5">
        <h2 class="fw-semibold">Đội ngũ của chúng tôi</h2>
        <p>
            LaptopStore tự hào sở hữu đội ngũ nhân sự trẻ trung, năng động và đam mê công nghệ.  
            Mỗi thành viên đều mang trong mình tinh thần sáng tạo, trách nhiệm và khát vọng cống hiến để mang lại
            giá trị tốt nhất cho khách hàng.
        </p>
    </section>

    <!-- Liên hệ -->
    <section class="text-center mt-5">
        <h4>Bạn có câu hỏi hoặc muốn hợp tác?</h4>
        <p>📞 Gọi ngay: <strong>0123 456 789</strong> hoặc 📧 Email: <strong>support@laptopstore.vn</strong></p>
        <a href="{{ url('/contact') }}" class="btn btn-primary mt-3">Liên hệ với chúng tôi</a>
    </section>
</div>
 </div>
@endsection
@section('footer' , $viewData['footer'])