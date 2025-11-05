<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; // (không dùng ở file này, có thể bỏ nếu muốn)
use App\Models\Product;      // (không dùng)
use App\Models\Order;        // (không dùng)
use App\Models\Item;         // (không dùng)
use Illuminate\Support\Facades\Auth; // (không dùng)
use App\Http\Controllers\CartController; // (không dùng)
use App\Models\Category;     // Model Category: có quan hệ products
use App\Http\Controllers\Controller; // Base controller
use Illuminate\Database\Eloquent\Factories\HasFactory; // (không dùng)

class CategoriesController extends Controller
{
    /**
     * Hiển thị trang danh mục theo id.
     * @param int|string $id  ID danh mục cần lấy
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        // Lấy category theo id kèm quan hệ products (eager loading); 404 nếu không tồn tại
        $category = Category::with('products')->findOrFail($id);

        // Chuẩn bị dữ liệu cho view
        $viewData = [];
        $viewData["title"] = "Danh mục: " . $category->name; // Tiêu đề hiển thị
        $viewData["products"] = $category->products;          // Danh sách sản phẩm thuộc danh mục

        // Trả về view categories.index cùng biến viewData
        return view('categories.index')->with("viewData", $viewData);
    }
}
