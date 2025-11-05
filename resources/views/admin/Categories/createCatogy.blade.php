@extends('layouts.admin') 
{{-- Kế thừa layout chung cho trang admin --}}

@section('title', 'Add Category') 
{{-- Đặt tiêu đề trang --}}

@section('content')
<div class="container mt-4">

    {{-- Tiêu đề trang --}}
    <h1 class="mb-4">Add New Category</h1>

    {{-- Form thêm mới danh mục --}}
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf {{-- Bảo vệ form chống tấn công CSRF --}}

        {{-- Nhập tên danh mục --}}
        <div class="form-group mb-3">
            <label for="name" class="form-label fw-bold">Category Name:</label>
            <input 
                type="text" 
                id="name"
                name="name" 
                value="{{ old('name') }}" 
                class="form-control @error('name') is-invalid @enderror" 
                placeholder="Enter category name" 
                required
            >
            {{-- Hiển thị lỗi nếu có --}}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nhập mô tả --}}
        <div class="form-group mb-3">
            <label for="description" class="form-label fw-bold">Description:</label>
            <textarea 
                id="description" 
                name="description" 
                class="form-control @error('description') is-invalid @enderror" 
                rows="4" 
                placeholder="Enter category description"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút lưu --}}
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Save
        </button>

        {{-- Nút quay lại danh sách --}}
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </form>
</div>
@endsection
