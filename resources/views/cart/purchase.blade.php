@extends('layouts.app') {{-- Kế thừa layout chung --}}
@section('title', $viewData["title"])      {{-- Set <title> --}}
@section('subtitle', $viewData["subtitle"]){{-- Phụ đề nếu layout có dùng --}}

@section('content')
<div class="container py-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thông tin khách hàng</h5> {{-- Tiêu đề form --}}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('cart.purchase') }}"> {{-- Gửi về route mua hàng --}}
                @csrf {{-- Bảo vệ CSRF --}}

                {{-- Danh xưng --}}
                <div class="mb-3">
                    <label class="form-label">Danh xưng</label>
                    <select class="form-select" name="gender" required>
                        <option value="">-- Chọn --</option>
                        <option value="Anh">Anh</option>
                        <option value="Chị">Chị</option>
                    </select>
                </div>

                {{-- Họ và tên: dùng input-group để nhãn dính cạnh ô nhập --}}
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Họ và tên</span>
                        <input id="fullname" type="text" name="fullname" class="form-control" placeholder="Nguyễn Văn A" required>
                    </div>
                </div>
            
                {{-- Số điện thoại --}}
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Số điện thoại</span>
                        <input type="text" name="phone" class="form-control" placeholder="Số điện thoại của bạn" required>
                    </div>
                </div>

                
                {{-- Địa chỉ --}}
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Địa chỉ</span>
                        <input type="text" name="address" class="form-control" placeholder="Số nhà, đường, phường, quận..." required>
                    </div>
                </div>

                {{-- Ghi chú (không bắt buộc) --}}
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">Ghi chú / yêu cầu khác (không bắt buộc)</span>
                        <input type="text" name="note" class="form-control" placeholder="Ví dụ: Giao buổi sáng...">
                        {{-- LƯU Ý: thẻ đóng </textarea> ở bản gốc dư; ở đây dùng <input> nên không cần </textarea> --}}
                    </div>
                </div>

                <hr>

                {{-- Bảng tóm tắt đơn hàng --}}
                <h5 class="mb-3">Tóm tắt đơn hàng</h5>
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp {{-- Biến cộng dồn tổng --}}
                        @foreach ($viewData["products"] as $product)
                            @php
                                $quantity = $viewData["productsInSession"][$product->getId()];    // SL từ session
                                $itemTotal = $product->getPrice() * $quantity;                    // Thành tiền dòng
                                $total += $itemTotal;                                             // Cộng vào tổng
                            @endphp
                            <tr>
                                <td>{{ $product->getName() }}</td>
                                <td>{{ $quantity }}</td>
                                <td>${{ number_format($product->getPrice(), 2) }}</td>
                                <td>${{ number_format($itemTotal, 2) }}</td>
                            </tr>
                        @endforeach

                        
                        
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary">
                            <th colspan="3" class="text-end">Tổng cộng:</th>
                            <th>${{ number_format($total, 2) }}</th> {{-- Hiển thị tổng --}}
                        </tr>
                    </tfoot>
                </table>

                {{-- Nút đặt hàng --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5 py-2">
                        Đặt hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
