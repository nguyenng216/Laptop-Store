@extends('layouts.admin')
@section('title', 'Admin Dashboard - Products')

@section('content')
<div class="container-fluid py-4">

    {{-- Tiêu đề + nút thêm --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-box-seam me-2 text-primary"></i>Quản lý sản phẩm
        </h2>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form thêm sản phẩm --}}
    <div class="card border-0 shadow-sm rounded-3 mb-5">
        <div class="card-header bg-light fw-bold">
            <i class="bi bi-plus-circle-fill text-success me-1"></i> Thêm sản phẩm mới
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($viewData['category'] as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Mô tả</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Giá</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Giá khuyến mãi</label>
                        <input type="number" name="discounted_price" class="form-control" value="{{ old('discounted_price') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Số lượng</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Ngừng hoạt động</option>
                        </select>
                    </div>
                </div>

                {{-- Cấu hình kỹ thuật --}}
                <div class="row mt-3">
                    <div class="col-md-4"><label>CPU</label><input type="text" name="cpu" class="form-control" value="{{ old('cpu') }}"></div>
                    <div class="col-md-4"><label>GPU</label><input type="text" name="gpu" class="form-control" value="{{ old('gpu') }}"></div>
                    <div class="col-md-4"><label>RAM</label><input type="text" name="ram" class="form-control" value="{{ old('ram') }}"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4"><label>Storage</label><input type="text" name="storage" class="form-control" value="{{ old('storage') }}"></div>
                    <div class="col-md-4"><label>Display</label><input type="text" name="display" class="form-control" value="{{ old('display') }}"></div>
                    <div class="col-md-4"><label>Weight</label><input type="text" name="weight" class="form-control" value="{{ old('weight') }}"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4"><label>Bảo hành</label><input type="text" name="warranty" class="form-control" value="{{ old('warranty', '12 tháng') }}"></div>
                    <div class="col-md-4"><label>Xuất xứ</label><input type="text" name="origin" class="form-control" value="{{ old('origin') }}"></div>
                    <div class="col-md-4"><label>Màu sắc</label><input type="text" name="color" class="form-control" value="{{ old('color') }}"></div>
                </div>

                <div class="mt-3 mb-4">
                    <label class="form-label fw-semibold">Hình ảnh</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-cloud-upload-fill me-1"></i>Thêm sản phẩm
                </button>
            </form>
        </div>
    </div>

    {{-- Bảng hiển thị sản phẩm --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-light fw-bold">
            <i class="bi bi-list-ul text-secondary me-1"></i>Danh sách sản phẩm
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Slug</th>
                            <th>Giá</th>
                            <th>KM</th>
                            <th>Tồn</th>
                            <th>Danh mục</th>
                            <th>TT</th>
                            <th>Ảnh</th>
                            <th>Chỉnh sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($viewData['product'] as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start fw-semibold">{{ $product->name }}</td>
                            <td class="text-muted">{{ $product->slug }}</td>
                            <td>{{ number_format($product->price) }}</td>
                            <td>{{ $product->discounted_price ? number_format($product->discounted_price) : '-' }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->category?->name ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}" width="60" class="rounded">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-warning btn-sm rounded-pill">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-pill">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>Chưa có sản phẩm nào
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Phân trang --}}
            
        </div>
    </div>

</div>
@endsection
