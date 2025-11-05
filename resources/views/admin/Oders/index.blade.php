@extends('layouts.admin')
@section('title', 'Quản lý orders')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📦 Danh sách đơn hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Người đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ number_format($order->total) }} đ</td>
                <td>
                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'paid' ? 'info' : ($order->status == 'shipped' ? 'success' : 'danger')) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.oders.show', $order->id) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                    <a href="{{ route('admin.oders.edit', $order->id) }}" class="btn btn-sm btn-warning">Cập nhật</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection