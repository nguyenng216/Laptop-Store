@extends('layouts.admin')
@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Sửa sản phẩm: {{ $product->name }}</h2>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Giá khuyến mãi</label>
                <input type="number" name="discounted_price" class="form-control" value="{{ old('discounted_price', $product->discounted_price) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh</label><br>
            @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
