<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class AdminProductController extends Controller
{
    public function index(): View
    {
        return view('admin.product', [
            'title'    => 'Admin - Products',
            'products' => Product::query()->latest('id')->get(),
        ]);
    }

    // Thêm các action khác khi cần:
    // public function create(): View { ... }
    // public function store(Request $request): RedirectResponse { ... }
    // public function edit(Product $product): View { ... }
    // public function update(Request $request, Product $product): RedirectResponse { ... }
    // public function destroy(Product $product): RedirectResponse { ... }
}
