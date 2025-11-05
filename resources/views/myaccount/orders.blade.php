@extends('layouts.app') {{-- Kế thừa layout chính --}}
@section('title', $viewData["title"])    {{-- Set <title> --}}
@section('subtitle', $viewData["subtitle"]) {{-- Phụ đề nếu layout có dùng --}}

@section('content')
<div class="home_container"> {{-- Khối bao nội dung, có style riêng --}}

@forelse ($viewData["orders"] as $order) {{-- Lặp qua danh sách đơn hàng; nếu rỗng sẽ vào @empty --}}

<div class="card mb-4 shadow-sm"> {{-- Mỗi đơn hàng là một card --}}
    <div class="card-header bg-primary text-white">
        <h5>Order #{{ $order->getId() }}</h5> {{-- Mã đơn --}}
    </div>

    <div class="card-body">
        <p><b>Date:</b> {{ $order->getCreatedAt() }}</p> {{-- Ngày tạo đơn --}}
        <p><b>Địa chỉ giao hàng:</b> {{ $order->address }}</p> {{-- Địa chỉ giao --}}
        <p><b>Số điện thoại:</b> {{ $order->phone }}</p> {{-- SĐT liên hệ --}}

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Item ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php $orderTotal = 0; @endphp {{-- Tổng tiền của đơn (cộng dồn) --}}

                @foreach ($order->getItems() as $item) {{-- Lặp qua từng dòng hàng trong đơn --}}
                    @php 
                        $itemTotal = $item->getPrice() * $item->getQuantity();  // Thành tiền của dòng
                        $orderTotal += $itemTotal;                               // Cộng dồn vào tổng đơn
                    @endphp
                    <tr>
                        <td>{{ $item->getId() }}</td> {{-- Mã item --}}
                        <td>
                            {{-- Tên sản phẩm, link sang trang chi tiết --}}
                            <a class="link-success" href="{{ route('product.show', ['id' => $item->getProduct()->getId()]) }}">
                                {{ $item->getProduct()->getName() }}
                            </a>
                        </td>
                        <td>${{ number_format($item->getPrice(), 2) }}</td>   {{-- Đơn giá (format 2 số lẻ) --}}
                        <td>{{ $item->getQuantity() }}</td>                    {{-- Số lượng --}}
                        <td>${{ number_format($itemTotal, 2) }}</td>           {{-- Thành tiền --}}
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th colspan="4" class="text-end">Order Total:</th>
                    <th>${{ number_format($orderTotal, 2) }}</th> {{-- Tổng đơn --}}
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@empty
{{-- Khi user chưa có đơn hàng nào --}}
<div class="alert alert-warning" role="alert">
    You have not purchased anything in our store yet.
</div>
@endforelse

</div>
@endsection
