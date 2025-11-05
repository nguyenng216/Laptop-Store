@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('style')
  <style>
    /* Ảnh card vuông, không méo */
    .card-img-cover{
      width: 100%;
      aspect-ratio: 1 / 1;
      object-fit: cover;
      display: block;
      border-top-left-radius: .375rem;
      border-top-right-radius: .375rem;
    }

    /* Bố cục card theo cột để đẩy nút xuống đáy */
    .product-card{ display:flex; flex-direction:column; }
    .product-card .card-body{ display:flex; flex-direction:column; }

    /* Nút CTA dính đáy card */
    .btn-cta{ margin-top:auto; }

    /* Giảm nhảy layout: fix chiều cao tối thiểu cho tiêu đề & khối giá (tùy bạn điều chỉnh) */
    .card-title{ min-height: 2.25rem; }    /* ~1-2 dòng */
    .price-block{ min-height: 2.5rem; }    /* đủ chứa 1-2 dòng giá */

    /* Giá xuống dòng */
    .price-old{ display:block; text-decoration: line-through; opacity:.7; }
    .price-sale{ display:block; color:#d32f2f; font-weight:700; }
  </style>
@endsection

@section('content')
<div class="row g-3">
  @foreach ($viewData['products'] as $product)
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card h-100 shadow-sm product-card"> {{-- thêm product-card --}}
        <img
          src="{{ asset('storage/' . $product->image) }}"
          onerror="this.onerror=null;this.src='{{ asset('img/' . $product->image) }}';"
          alt="{{ $product->name }}"
          class="card-img-cover"
          loading="lazy">

        <div class="card-body text-center">
          <h6 class="card-title text-dark mb-2">{{ $product->name }}</h6>

          @if(!empty($product->discount_price))
            <div class="mb-2 price-block">
              <span class="price-old">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
              <span class="price-sale">{{ number_format($product->discount_price, 0, ',', '.') }} VNĐ</span>
            </div>
          @elseif(!empty($product->price))
            <div class="mb-2 price-block">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
          @else
            <div class="mb-2 price-block"></div>
          @endif

          <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-danger btn-sm btn-cta">
            Xem chi tiết
          </a>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection
