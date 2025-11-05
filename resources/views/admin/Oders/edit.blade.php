@extends('layouts.admin')
@section('title', 'Cập nhật đơn hàng')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Cập nhật trạng thái đơn #{{ $order->id }}</h3>

    <form action="{{ route('admin.oders.update', $order->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="status" class="form-label fw-bold">Trạng thái:</label>
            <select name="status" id="status" class="form-select">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
        <a href="{{ route('admin.oders.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
