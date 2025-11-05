@extends('layouts.admin')
@section('title', 'Chỉnh sửa danh mục')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-pencil-square me-2"></i> Chỉnh sửa danh mục
        </h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Quay lại
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-folder-fill me-2"></i> Thông tin danh mục</h5>
        </div>

        <div class="card-body">
            {{-- Hiển thị lỗi nếu có --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Lỗi:</strong> 
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form chỉnh sửa danh mục --}}
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Tên danh mục</label>
                    <input type="text" name="name" id="name" class="form-control shadow-sm" 
                           value="{{ old('name', $category->name) }}" placeholder="Nhập tên danh mục..." required>
                    <div class="invalid-feedback">Vui lòng nhập tên danh mục.</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Mô tả</label>
                    <textarea name="description" id="description" class="form-control shadow-sm" rows="4"
                              placeholder="Nhập mô tả danh mục...">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light border">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Nhập lại
                    </button>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save2 me-1"></i> Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script kích hoạt Bootstrap validation --}}
@push('scripts')
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endpush
@endsection
