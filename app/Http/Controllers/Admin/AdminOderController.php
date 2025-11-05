<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class AdminOderController extends Controller
{
    /**
     * Hiển thị danh sách tất cả đơn hàng.
     */
    public function index()
    {
        // Lấy toàn bộ đơn hàng cùng thông tin user
        $orders = Order::with('user')->latest()->get();

        return view('admin.Oders.index', compact('orders'));
    }

    /**
     * Hiển thị chi tiết 1 đơn hàng.
     */
    public function show($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.Oders.show', compact('order'));
    }

    /**
     * Hiển thị form chỉnh sửa trạng thái đơn hàng.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $statuses = ['pending', 'paid', 'shipped', 'cancelled'];
        return view('admin.Oders.edit', compact('order', 'statuses'));
    }

    /**
     * Cập nhật trạng thái đơn hàng.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.oders.index')->with('success', 'Cập nhật trạng thái thành công!');
    }

    /**
     * Xóa đơn hàng (tuỳ chọn).
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.oders.index')->with('success', 'Đã xoá đơn hàng!');
    }
}


