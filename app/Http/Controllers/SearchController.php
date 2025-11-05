<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;                 // (không dùng trong file này)
use App\Models\Product;                      // Model Product
use App\Models\Order;                        // (không dùng)
use App\Models\Item;                         // (không dùng)
use Illuminate\Support\Facades\Auth;         // (không dùng)
use App\Http\Controllers\CartController;     // (không dùng)
use App\Models\Category;                     // (không dùng)
use App\Http\Controllers\Controller;         // Base controller
use Illuminate\Database\Eloquent\Factories\HasFactory; // (không dùng)

class SearchController extends Controller
{
    /**
     * Hiển thị kết quả tìm kiếm theo $id (hiện tại lấy 1 Product theo id).
     * LƯU Ý: Product::with('products') giả định có quan hệ 'products' trong Product.
     * Nếu không có quan hệ này, lệnh sẽ lỗi. Ở đây chỉ chú thích, không đổi logic.
     * @param int|string $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        // Lấy Product theo id kèm eager load quan hệ 'products' (nếu được định nghĩa)
        $product_searched = Product::with('products')->findOrFail($id);

        // Chuẩn bị dữ liệu cho view
        $viewData = [];
        $viewData["products"] = $product_searched->products; // Danh sách từ quan hệ 'products'

        // Trả về view search.index kèm dữ liệu
        return view('search.index')->with("viewData", $viewData);
    }
}
