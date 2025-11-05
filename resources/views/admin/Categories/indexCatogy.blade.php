@extends('layouts.admin')
@section('title', 'Quản lý danh mục')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-folder-fill me-2"></i> Quản lý danh mục
        </h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm danh mục
        </a>
    </div>

    {{-- Thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Bảng danh mục --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i> Danh sách danh mục</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">#</th>
                        <th width="20%">Tên danh mục</th>
                        <th>Mô tả</th>
                        <th width="20%">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="text-center text-muted">{{ $category->id }}</td>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td class="text-secondary">{{ $category->description ?: '—' }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                   class="btn btn-outline-warning btn-sm px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                                        <i class="bi bi-trash3"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4"></i> <br> Chưa có danh mục nào
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Phân trang nếu có --}}
        @if(method_exists($categories, 'links'))
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-center">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
