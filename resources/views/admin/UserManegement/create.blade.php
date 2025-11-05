@extends('layouts.admin')
{{-- Kế thừa layout chung cho trang admin --}}

@section('title', 'Add User')
{{-- Đặt tiêu đề trang --}}

@section('content')
<div class="container mt-4">

    {{-- Tiêu đề trang --}}
    <h2 class="mb-4">Add New User</h2>

    {{-- Form thêm mới người dùng --}}
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf {{-- Bảo vệ form khỏi tấn công CSRF --}}

        {{-- Nhập tên người dùng --}}
        <div class="form-group mb-3">
            <label for="name" class="form-label fw-bold">Full Name:</label>
            <input 
                type="text" 
                id="name"
                name="name" 
                value="{{ old('name') }}" 
                class="form-control @error('name') is-invalid @enderror" 
                placeholder="Enter full name"
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nhập email --}}
        <div class="form-group mb-3">
            <label for="email" class="form-label fw-bold">Email:</label>
            <input 
                type="email" 
                id="email"
                name="email" 
                value="{{ old('email') }}" 
                class="form-control @error('email') is-invalid @enderror" 
                placeholder="Enter email address"
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nhập mật khẩu --}}
        <div class="form-group mb-3">
            <label for="password" class="form-label fw-bold">Password:</label>
            <input 
                type="password" 
                id="password"
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Enter password"
                required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút thao tác --}}
        <button type="submit" class="btn btn-success">
            <i class="bi bi-person-plus"></i> Create
        </button>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </form>
</div>
@endsection
