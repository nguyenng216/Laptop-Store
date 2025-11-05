@extends('layouts.app')

@section('style')
  {{-- CSS riêng cho trang Category --}}
  <link rel="stylesheet" href="{{ asset('css/home_main/content_container.css') }}">
@endsection

@section('title', $viewData['title'])

@section('content')
<div class="home_container">
  {{-- Dải đỏ phía trên --}}
  <div class="border_full"></div>
  
  {{-- Vùng sản phẩm --}}
  <div class="products_wrap">
    <div class="row_banner">
      @forelse ($viewData['products'] as $product)
        <div class="box_banner">
          <a href="{{ route('product.show', ['id' => $product->getId()]) }}" class="card">
            {{-- Hình ảnh --}}
            <img class="img_banner"
                 src="{{ asset('storage/products/' . $product->getImage()) }}"
                 alt="{{ $product->getName() }}">

            {{-- Thông tin sản phẩm --}}
            <div class="card-body">
              <h2 class="size_text_banner">{{ $product->getName() }}</h2>
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
      @empty
        <p class="text-muted text-center mt-4">Không có sản phẩm nào trong danh mục này.</p>
      @endforelse
    </div>
  </div>

  {{-- Dải phân cách dưới --}}
  <div class="border_full mt-4"></div>
</div>
@endsection

@section('footer')
  © 2025 LaptopShop. All rights reserved.
@endsection
    