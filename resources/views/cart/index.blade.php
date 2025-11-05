@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="home_container">
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">🛒 Products in Cart</h5>
    </div>
    <div class="card-body bg-light">

        {{-- Thông báo --}}
        @if(session('success'))
            <div class="alert alert-success text-center fw-bold">{{ session('success') }}</div>
        @endif

        {{-- Kiểm tra giỏ hàng --}}
        @if(count($viewData["products"]) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center bg-white">
                <thead class="table-primary">
                    <tr>                    
                        <th>Image</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php $cartTotal = 0; @endphp
                @foreach ($viewData["products"] as $product)
                    @php
                        $qty = session('products')[$product->getId()];
                        $totalPrice = $product->getPrice() * $qty;
                        $cartTotal += $totalPrice;
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('storage/products/' . $product->getImage()) }}" 
                                 alt="{{ $product->getName() }}" 
                                 class="img-thumbnail rounded" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td>{{ $product->getId() }}</td>
                        <td class="fw-semibold">{{ $product->getName() }}</td>
                        <td>${{ number_format($product->getPrice(), 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', ['id' => $product->getId()]) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                @csrf
                                <input type="number" 
                                       name="quantity" 
                                       value="{{ $qty }}" 
                                       min="1"
                                       class="form-control text-center" 
                                       style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-success ms-2">
                                    <i class="bi bi-arrow-repeat"></i> Update
                                </button>
                            </form>
                        </td>
                        <td class="fw-bold">${{ number_format($totalPrice, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', ['id' => $product->getId()]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash3"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="5" class="text-end text-uppercase">Total to Pay:</th>
                        <th colspan="2" class="text-danger fw-bold">${{ number_format($cartTotal, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Nút hành động --}}
        <div class="text-end mt-3">
            <a href="{{ route('cart.purchase') }}" class="btn btn-success me-2">
                <i class="bi bi-credit-card"></i> Purchase
            </a>
            <a href="{{ route('cart.delete') }}" class="btn btn-outline-danger">
                <i class="bi bi-x-circle"></i> Remove All
            </a>
        </div>

        @else
            <div class="alert alert-warning text-center">
                🛍️ Your cart is empty.
            </div>
        @endif
    </div>
</div>
</div>
@endsection
