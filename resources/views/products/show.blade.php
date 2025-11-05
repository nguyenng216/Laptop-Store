@extends('layouts.app')  {{-- Kế thừa layout chung --}}

@section('style')
  {{-- Nạp CSS riêng cho trang chi tiết sản phẩm --}}
  <link rel="stylesheet" href="{{ asset('css/product/product_show.css') }}">
@endsection

@section('title', $viewData['title']) {{-- Set <title> động từ controller --}}

@section('content')
<div class="product_show">                {{-- Khung tổng: nền trắng, viền đỏ, chừa sidebar trái --}}
  <div class="product_wrap">              {{-- Căn giữa theo max-width giống Home --}}

    <div class="content_product"><p>Detail Product</p></div>
    <div class="product_divider"></div>

    <!-- Bố cục 2 cột: TRÁI (ảnh + nội dung) | PHẢI (cấu hình & info khác) -->
    <div class="container_product grid-2">
      
      <!-- ========== CỘT TRÁI: Ảnh + Thông tin cơ bản ========== -->
      <section class="left_main">
        <div class="left_product">
          <img class="img_product"
               src="{{ asset('storage/products/' . $viewData['products']->image) }}"
               alt="{{ $viewData['products']->name }}">
        </div>

        <article class="main_info card_box">
          <h2 class="prod_title">{{ $viewData['products']->name }}</h2>

          {{-- Giá: có giảm thì gạch giá cũ + tô đỏ giá mới --}}
          <p class="price">
            @if($viewData['products']->discount_price)
              <span class="price--old">{{ number_format($viewData['products']->price, 0, ',', '.') }} VNĐ</span>
              <span class="price--sale">{{ number_format($viewData['products']->discount_price, 0, ',', '.') }} VNĐ</span>
            @else
              <span class="price--now">{{ number_format($viewData['products']->price, 0, ',', '.') }} VNĐ</span>
            @endif
          </p>

          <p class="desc">
            <strong>Description:</strong> {{ $viewData['products']->description }}
          </p>

          {{-- <div class="meta_inline">
            <span><strong>Stock:</strong> {{ $viewData['products']->stock }}</span>
            <span><strong>Category:</strong> {{ $viewData['products']->category }}</span>
          </div> --}}
        </article>
      </section>

      <!-- ========== CỘT PHẢI: CẤU HÌNH & THÔNG TIN KHÁC (SIDEBAR) ========== -->
      <aside class="right_aside">
        <div class="card_box sticky_aside">
          <p class="card-text">
                    <form method="POST" action="{{ route('cart.add',['id'=>$viewData['products']->getId()]) }}">
                        <div class="row">
                            @csrf
                            <div class="col-auto">
                                <div class="input-group col-auto">
                                    <div class="input-group-text">Quantity</div>
                                    <input type="number" min="1" max="10" class="form-control quantity-input" name="quantity" value="1">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn bg-primary text-white" type="submit">Add to cart</button>
                            </div>
                        </div>
                    </form>
          </p>
        </div>


        <div class="card_box sticky_aside">
          <h4 class="box_title">Cấu hình</h4>
          <ul class="spec_list">
            <li><span>CPU</span><strong>{{ $viewData['products']->cpu ?? '—' }}</strong></li>
            <li><span>GPU</span><strong>{{ $viewData['products']->gpu ?? '—' }}</strong></li>
            <li><span>RAM</span><strong>{{ $viewData['products']->ram ?? '—' }}</strong></li>
            <li><span>Storage</span><strong>{{ $viewData['products']->storage ?? '—' }}</strong></li>
            <li><span>Display</span><strong>{{ $viewData['products']->display ?? '—' }}</strong></li>
            <li><span>Weight</span><strong>{{ $viewData['products']->weight ?? '—' }}</strong></li>
          </ul>

          <h4 class="box_title mt-3">Thông tin khác</h4>
          <ul class="spec_list">
            <li><span>Bảo hành</span><strong>{{ $viewData['products']->warranty ?? '12 tháng' }}</strong></li>
            <li><span>Xuất xứ</span><strong>{{ $viewData['products']->origin ?? '—' }}</strong></li>
            <li><span>Màu sắc</span><strong>{{ $viewData['products']->color ?? '—' }}</strong></li>
          </ul>
        </div>
        
      </aside>

    </div>
    <!-- /container_product -->
    
<!--################################################### review #######################################################3-->
  <div class="content_product">
  
  <h2 class="mb-4">Đánh giá sản phẩm</h2>

  <div class="row g-3">
    <!-- Review 1 -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=1" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Nguyễn Văn A</h6>
              <small class="text-muted">28/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★★★☆</div>
          </div>
          <p class="card-text">Sản phẩm chất lượng, giao hàng nhanh. Rất hài lòng với trải nghiệm mua sắm!</p>
        </div>
      </div>
    </div>

    <!-- Review 2 -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=2" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Trần Thị B</h6>
              <small class="text-muted">27/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★★★★</div>
          </div>
          <p class="card-text">Chất lượng vượt mong đợi, sẽ ủng hộ tiếp lần sau!</p>
        </div>
      </div>
    </div>

    <!-- Review 3 -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=3" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Lê Văn C</h6>
              <small class="text-muted">26/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★★☆☆</div>
          </div>
          <p class="card-text">Sản phẩm tốt nhưng đóng gói hơi sơ sài, cần cải thiện.</p>
        </div>
      </div>
    </div>

    <!-- Review 4 -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=4" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Phạm Thị D</h6>
              <small class="text-muted">25/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★★★☆</div>
          </div>
          <p class="card-text">Sản phẩm đúng mô tả, nhân viên tư vấn nhiệt tình.</p>
        </div>
      </div>
    </div>

    <!-- Review 5 - Negative -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=5" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Hoàng Văn E</h6>
              <small class="text-muted">24/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★☆☆☆☆</div>
          </div>
          <p class="card-text">Hàng giao trễ, sản phẩm bị trầy xước. Không hài lòng.</p>
        </div>
      </div>
    </div>

    <!-- Review 6 - Negative -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=6" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Ngô Thị F</h6>
              <small class="text-muted">23/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★☆☆☆</div>
          </div>
          <p class="card-text">Chất lượng không như quảng cáo, màu sắc khác nhiều.</p>
        </div>
      </div>
    </div>

    <!-- Review 7 - Negative -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=7" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Trương Văn G</h6>
              <small class="text-muted">22/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★★☆☆</div>
          </div>
          <p class="card-text">Sản phẩm dùng được nhưng chất liệu không bền, cần cải tiến.</p>
        </div>
      </div>
    </div>

    <!-- Review 8 - Negative -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=8" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Phan Thị H</h6>
              <small class="text-muted">21/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★☆☆☆☆</div>
          </div>
          <p class="card-text">Nhân viên tư vấn kém, không hỗ trợ đổi trả.</p>
        </div>
      </div>
    </div>

    <!-- Review 9 - Negative -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=9" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Đinh Văn I</h6>
              <small class="text-muted">20/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★★☆☆☆</div>
          </div>
          <p class="card-text">Đóng gói sơ sài, sản phẩm dễ hỏng khi vận chuyển.</p>
        </div>
      </div>
    </div>

    <!-- Review 10 - Negative -->
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://i.pravatar.cc/40?img=10" class="rounded-circle me-2" alt="avatar">
            <div>
              <h6 class="mb-0">Lưu Thị J</h6>
              <small class="text-muted">19/10/2025</small>
            </div>
            <div class="ms-auto text-warning">★☆☆☆☆</div>
          </div>
          <p class="card-text">Chất lượng tệ, giao hàng chậm, không đáng tiền.</p>
        </div>
      </div>
    </div>
</div>


</div>
<!--################################################### end review #######################################################3-->

  </div>
</div>
@endsection

@section('footer', $viewData['footer'])  {{-- Nội dung dòng bản quyền/ghi chú ở footer --}}
