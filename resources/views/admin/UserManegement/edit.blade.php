@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">✏️ Edit User</h2>

    {{-- Form cập nhật thông tin người dùng --}}
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="shadow-sm p-4 rounded bg-light">
        @csrf
        @method('PUT')

        {{-- Tên người dùng --}}
        <div class="form-group mb-3">
            <label for="name" class="form-label fw-bold">Full Name:</label>
            <input 
                type="text" 
                id="name"
                name="name" 
                value="{{ old('name', $user->name) }}" 
                class="form-control @error('name') is-invalid @enderror" 
                placeholder="Enter user's full name" 
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group mb-3">
            <label for="email" class="form-label fw-bold">Email Address:</label>
            <input 
                type="email" 
                id="email"
                name="email" 
                value="{{ old('email', $user->email) }}" 
                class="form-control @error('email') is-invalid @enderror" 
                placeholder="Enter user's email" 
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Trạng thái --}}
        <div class="form-group mb-4">
            <label for="status" class="form-label fw-bold">Account Status:</label>
            <select 
                id="status"
                name="status" 
                class="form-select @error('status') is-invalid @enderror"
            >
                <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>✅ Active</option>
                <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>🚫 Inactive</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút thao tác --}}
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>
    </form>
</div>
@endsection
