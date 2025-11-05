@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4>Chi tiết đơn hàng #{{ $order->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Khách hàng:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total) }} đ</p>
            <p><strong>Trạng thái:</strong> 
                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'paid' ? 'info' : ($order->status == 'shipped' ? 'success' : 'danger')) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.oders.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
