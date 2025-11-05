@extends('layouts.app')  {{-- Kế thừa layout chung --}}

@section('style')
  {{-- Nạp CSS riêng cho trang Home (lưới sản phẩm, màu đỏ–trắng, căn giữa) --}}
  <link rel="stylesheet" href="{{ asset('css/home_main/content_container.css') }}">
@endsection

@section('title', $viewData['title']) {{-- Set <title> động từ controller --}}

@section('content')
<div class="home_container">  {{-- Khung tổng của trang Home: viền đỏ, nền trắng, chừa chỗ sidebar --}}

  <div class="border_full"></div>  {{-- Dải phân cách đỏ phía trên --}}

  <div class="products_wrap">  {{-- Giới hạn bề ngang & căn giữa toàn bộ cụm sản phẩm --}}
    <div class="row_banner">   {{-- Hàng sản phẩm: flex-wrap + justify-center --}}
      @foreach ($viewData['discount_products'] as $product)
        @if  ($product->discount_price)
         <div class="box_banner">   {{-- Mỗi “ô” sản phẩm: width cố định để căn giữa đẹp --}}
          <a href="{{ route('product.show', ['id' => $product->id]) }}" class="card"> {{-- Card có thể click toàn khối --}}
            <img class="img_banner"
                 src="{{ asset('storage/products/' . $product->image) }}"     {{-- Ảnh sản phẩm (yêu cầu storage:link) --}}
                 alt="{{ $product->name }}">                         {{-- Alt để SEO + truy cập --}}

            <div class="card-body">  {{-- Vùng text của card --}}
              <h2 class="size_text_banner">{{ $product->name }}</h2>

              {{-- Hiển thị giá: nếu có giảm giá thì gạch giá cũ + tô đỏ giá mới --}}
              <p class="size_text_banner">
                @if ($product->discount_price)
                  <span style="text-decoration:line-through;opacity:.7">
                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                  </span>
                  &nbsp;
                  <span class="discount_tag">
                    {{ number_format($product->discount_price, 0, ',', '.') }} VNĐ
                  </span>
                @else
                  {{ number_format($product->price, 0, ',', '.') }} VNĐ
                @endif
              </p>
            </div>
          </a>
        </div>
      @endif
      @endforeach
    </div>
  </div>

  

  {{-- Hàng thứ 2: hiển thị sản phẩm theo danh mục (categories) --}}
<div class="products_wrap">
  
  @foreach ($viewData['categories'] as $category)
    <h4 id="category-{{ $category->id }}" class="text-primary mt-4 mb-3"></h4>

   <div class="border_full"></div>
    {{-- Tiêu đề danh mục --}}
    <h4 class="text-primary mt-4 mb-3">🏷 {{ $category->name }}</h4>

   {{-- Thêm id cho anchor link --}}

    <div class="row_banner">
      @forelse ($category->products as $product)
        @if (!($product->discount_price))  {{-- Bỏ qua sản phẩm có giảm giá --}}
          <div class="box_banner">   {{-- Mỗi “ô” sản phẩm: width cố định để căn giữa đẹp --}}
            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="card"> {{-- Card có thể click toàn khối --}}
              <img class="img_banner"
                   src="{{ asset('storage/products/' . $product->image) }}"     {{-- Ảnh sản phẩm (yêu cầu storage:link) --}}
                   alt="{{ $product->name }}">                         {{-- Alt để SEO + truy cập --}}
              
              <div class="card-body">  {{-- Vùng text của card --}}
                <h2 class="size_text_banner">{{ $product->name }}</h2>

                {{-- Hiển thị giá: nếu có giảm giá thì gạch giá cũ + tô đỏ giá mới --}}
                <p class="size_text_banner">
                  @if ($product->discount_price)
                    <span style="text-decoration:line-through;opacity:.7">
                      {{ number_format($product->price, 0, ',', '.') }} VNĐ
                    </span>
                    &nbsp;
                    <span class="discount_tag">
                      {{ number_format($product->discount_price, 0, ',', '.') }} VNĐ
                    </span>
                  @else
                    {{ number_format($product->price, 0, ',', '.') }} VNĐ
                  @endif
                </p>
              </div>
            </a>
          </div>
        @endif
      @empty
        <p class="text-muted ms-3">Không có sản phẩm nào trong danh mục này.</p>
      @endforelse
    </div>
  @endforeach
</div>


</div>
@endsection

@section('footer')
  © 2024 LaptopShop. All rights reserved.
@endsection
