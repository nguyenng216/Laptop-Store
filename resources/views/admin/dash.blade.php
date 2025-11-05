@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
    </h2>

    {{-- Thống kê tổng quát --}}
    <div class="row mb-4 g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-2 text-success">
                        <i class="bi bi-box-seam display-5"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-secondary">Tổng số sản phẩm</h5>
                    <h2 class="fw-bold text-dark mt-2">{{ $viewData['total_products'] }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-2 text-primary">
                        <i class="bi bi-people-fill display-5"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-secondary">Tổng số người dùng</h5>
                    <h2 class="fw-bold text-dark mt-2">{{ $viewData['total_users'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Sản phẩm mới nhất --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-gradient bg-success text-white fw-semibold d-flex align-items-center">
            <i class="bi bi-bag-check-fill me-2"></i> Sản phẩm mới nhất
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['latest_products'] as $index => $p)
                    <tr>
                        <td class="fw-semibold">{{ $index + 1 }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ number_format($p->price) }} đ</td>
                        <td>
                            <span class="badge 
                                {{ $p->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @if($viewData['latest_products']->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Không có sản phẩm nào gần đây</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Người dùng mới nhất --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient bg-primary text-white fw-semibold d-flex align-items-center">
            <i class="bi bi-person-lines-fill me-2"></i> Người dùng mới đăng ký
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['latest_users'] as $index => $u)
                    <tr>
                        <td class="fw-semibold">{{ $index + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td><span class="text-muted">{{ $u->created_at->format('d/m/Y') }}</span></td>
                    </tr>
                    @endforeach
                    @if($viewData['latest_users']->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">Không có người dùng mới</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
