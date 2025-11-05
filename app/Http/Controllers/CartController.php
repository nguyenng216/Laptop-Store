<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Xử lý đặt mua: tạo Order + Item từ giỏ trong session, trừ số dư user, xoá giỏ.
     */
    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get("products"); // Lấy giỏ hàng từ session (id => qty)
        if ($productsInSession) {

            // ✅ Validate thông tin khách hàng (đầu vào form thanh toán)
            $validated = $request->validate([
                'gender' => 'required|string',
                'fullname' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'note' => 'nullable|string|max:500',
            ]);

            $userId = Auth::user()->getId(); // Id người dùng hiện tại
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotal(0); // Khởi tạo tổng = 0, sẽ cập nhật sau

            // ✅ Lưu thông tin KH vào đơn (cần có các cột tương ứng trong bảng orders)
            $order->gender = $validated['gender'];
            $order->fullname = $validated['fullname'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->note = $validated['note'] ?? null;

            $order->save(); // Lưu Order trước để có order_id

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession)); // Lấy model Product theo danh sách id
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()]; // Số lượng từ session

                // Tạo Item (chi tiết dòng sản phẩm)
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();

                // Cộng dồn tổng tiền
                $total = $total + ($product->getPrice() * $quantity);
            }

            // Cập nhật tổng tiền cho Order
            $order->setTotal($total);
            $order->save();

            // Trừ số dư của user (giả định user có thuộc tính balance)
            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();

            // Xoá giỏ hàng trong session
            $request->session()->forget('products');

            // Dữ liệu view (không dùng ngay vì redirect)
            $viewData = [];
            $viewData["title"] = "Purchase - Online Store";
            $viewData["subtitle"] = "Purchase Status";
            $viewData["order"] = $order;

            // Quay lại trang giỏ hàng
            return redirect()->route('cart.index');
        } else {
            // Không có sản phẩm trong giỏ -> quay lại giỏ
            return redirect()->route('cart.index');
        }
    }

    /**
     * Trang giỏ hàng: hiển thị danh sách sản phẩm + tổng tiền.
     */
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];
        $productsInSession = $request->session()->get("products"); // Lấy giỏ (id => qty)

        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession)); // Lấy các product theo id
            $total = Product::sumPricesByQuantities($productsInCart, $productsInSession); // Tính tổng theo qty
        }

        // Chuẩn bị dữ liệu cho view
        $viewData = [];
        $viewData["title"] = "Cart - Laptop Store";
        $viewData["subtitle"] = "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["products"] = $productsInCart;

        return view('cart.index')->with("viewData", $viewData);
    }

    /**
     * Thêm/cập nhật sản phẩm vào giỏ (session). Expect input 'quantity'.
     */
    public function add(Request $request, $id)
    {
        $products = $request->session()->get("products"); // Lấy giỏ hiện tại (có thể null)
        $products[$id] = $request->input('quantity');     // Gán số lượng cho id sản phẩm
        $request->session()->put('products', $products);  // Lưu lại giỏ
        return redirect()->route('cart.index');           // Quay lại giỏ
    }

    /**
     * Xoá toàn bộ giỏ hàng khỏi session.
     */
    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    /**
     * Cập nhật số lượng cho 1 sản phẩm trong giỏ.
     */
    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1' // Số lượng tối thiểu 1
        ]);

        $products = $request->session()->get('products', []); // Lấy giỏ (mặc định mảng rỗng)

        if (isset($products[$id])) {
            $products[$id] = $request->input('quantity'); // Cập nhật qty
            $request->session()->put('products', $products);
        }

        return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công!');
    }
    
    /**
     * Xoá 1 sản phẩm khỏi giỏ theo id.
     */
    public function remove(Request $request, $id)
    {
        $products = $request->session()->get('products', []); // Lấy giỏ

        if (isset($products[$id])) {
            unset($products[$id]);                             // Bỏ sản phẩm khỏi giỏ
            $request->session()->put('products', $products);   // Lưu lại
        }

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    /**
     * Hiển thị form/summary trước khi thanh toán (purchase).
     */
    public function showPurchase()
    {
        $productsInSession = session()->get("products");                // Lấy giỏ
        $products = Product::findMany(array_keys($productsInSession ?? [])); // Lấy danh sách Product (nếu có)

        // Chuẩn bị dữ liệu view
        $viewData = [];
        $viewData["title"] = "Thanh toán đơn hàng";
        $viewData["subtitle"] = "Nhập thông tin khách hàng";
        $viewData["products"] = $products;
        $viewData["productsInSession"] = $productsInSession;

        return view('cart.purchase')->with("viewData", $viewData);
    }
}
