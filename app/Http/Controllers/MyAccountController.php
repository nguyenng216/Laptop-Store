<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;                 // (không dùng ở file này, có thể bỏ)
use App\Models\Order;                        // Model Order
use Illuminate\Support\Facades\Auth;         // Lấy user hiện tại
use App\Http\Controllers\CartController;     // (không dùng, có thể bỏ)

class MyAccountController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng của người dùng đang đăng nhập.
     * @return \Illuminate\View\View
     */
    public function orders()
    {
        $viewData = [];
        $viewData["title"] = "My Orders - Online Store"; // Tiêu đề trang
        $viewData["subtitle"] = "My Orders";             // Phụ đề

        // Lấy toàn bộ đơn hàng theo user hiện tại (dùng cột user_id)
        $viewData["orders"] = Order::where('user_id', Auth::user()->getId())->get();

        // Trả về view kèm mảng dữ liệu
        return view('myaccount.orders')->with("viewData", $viewData);
    }
}
