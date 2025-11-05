<?php

namespace app\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
     public function index()
    {
        // Dữ liệu cho view
        $viewData = [];
        $viewData['title'] = "Admin Dashboard";

        // Đếm tổng số sản phẩm và người dùng
        $viewData['total_products'] = Product::count();
        $viewData['total_users'] = User::count();

        // Lấy 5 sản phẩm mới nhất
        $viewData['latest_products'] = Product::orderBy('created_at', 'desc')->take(5)->get();

        // Lấy 5 người dùng mới nhất
        $viewData['latest_users'] = User::orderBy('created_at', 'desc')->take(5)->get();

        // Trả về view
        return view('admin.dash')->with('viewData', $viewData);
    }

  public function createProducts(){
        $viewData= [];
        $viewData['title'] = "Admin Dashboard" ;
        $viewData['category'] = Category::all();
        $viewData['product'] = Product::all();

        return view('admin.main') ->with("viewData", $viewData);
    }


    ########################function dung de them san pham moi ##########################
   public function store(Request $request){
    // 1 . Validate dữ liệu đầu vào
    $request->validate([
        'name'             => 'required|max:225',
        'description'      => 'required',
        'price'            => 'required|numeric|gt:0',
        'discounted_price' => 'nullable|numeric|lt:price',
        'stock'            => 'nullable|integer|min:0',
        'category_id'      => 'nullable|exists:categories,id',
        'status'           => 'nullable|in:active,inactive',
        'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        // thêm validate cho cấu hình
        'cpu'       => 'nullable|string|max:255',
        'gpu'       => 'nullable|string|max:255',
        'ram'       => 'nullable|string|max:255',
        'storage'   => 'nullable|string|max:255',
        'display'   => 'nullable|string|max:255',
        'weight'    => 'nullable|string|max:255',
        'warranty'  => 'nullable|string|max:255',
        'origin'    => 'nullable|string|max:255',
        'color'     => 'nullable|string|max:255',
    ]);

     $baseSlug = Str::slug($request->input('name'));
    // 2️ . Tạo sản phẩm mới, trước mắt chưa có hình
    $product = Product::create([
            'name'             => $request->input('name'),
            'slug'             => $baseSlug,
            'description'      => $request->input('description'),
            'price'            => $request->input('price'),
            'discounted_price' => $request->input('discounted_price', null),
            'stock'            => $request->input('stock', 0),
            'category_id'      => $request->input('category_id', null),
            'status'           => $request->input('status', 'active'),
            'image'            => null,

            // các thông số cấu hình
            'cpu'       => $request->input('cpu', null),
            'gpu'       => $request->input('gpu', null),
            'ram'       => $request->input('ram', null),
            'storage'   => $request->input('storage', null),
            'display'   => $request->input('display', null),
            'weight'    => $request->input('weight', null),
            'warranty'  => $request->input('warranty', '12 tháng'),
            'origin'    => $request->input('origin', null),
            'color'     => $request->input('color', null),
        ]);
    // 3️ . Nếu có hình thì xử lý upload
    if ($request->hasFile('image')) {
            $imageName = $product->slug . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('products', $imageName, 'public');
            $product->update(['image' => $imageName]);
        }
    

    // 4️ . Quay lại trang trước và báo thành công
    return back()->with('success', 'Thêm sản phẩm thành công!');
}

#####################function dung de xoa san pham ##########################
    public function delete($id){
        Product::destroy($id);
        return back();
    }

     public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit', compact('product', 'categories'));
    }

    ##################### Cập nhật sản phẩm ##########################
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'             => 'required|max:225',
            'description'      => 'required',
            'price'            => 'required|numeric|gt:0',
            'discounted_price' => 'nullable|numeric|lt:price',
            'stock'            => 'nullable|integer|min:0',
            'category_id'      => 'nullable|exists:categories,id',
            'status'           => 'nullable|in:active,inactive',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // thêm validate cho cấu hình
            'cpu'       => 'nullable|string|max:255',
            'gpu'       => 'nullable|string|max:255',
            'ram'       => 'nullable|string|max:255',
            'storage'   => 'nullable|string|max:255',
            'display'   => 'nullable|string|max:255',
            'weight'    => 'nullable|string|max:255',
            'warranty'  => 'nullable|string|max:255',
            'origin'    => 'nullable|string|max:255',
            'color'     => 'nullable|string|max:255',
        ]);


        $baseSlug = Str::slug($request->input('name'));

        // Cập nhật dữ liệu
        $product->update([
    'name'             => $request->input('name'),
    'slug'             => $baseSlug,
    'description'      => $request->input('description'),
    'price'            => $request->input('price'),
    'discounted_price' => $request->input('discounted_price', null),
    'stock'            => $request->input('stock', 0),
    'category_id'      => $request->input('category_id', null),
    'status'           => $request->input('status', 'active'),

    // các thông số cấu hình
    'cpu'       => $request->input('cpu', null),
    'gpu'       => $request->input('gpu', null),
    'ram'       => $request->input('ram', null),
    'storage'   => $request->input('storage', null),
    'display'   => $request->input('display', null),
    'weight'    => $request->input('weight', null),
    'warranty'  => $request->input('warranty', '12 tháng'),
    'origin'    => $request->input('origin', null),
    'color'     => $request->input('color', null),
]);

        // Cập nhật hình ảnh nếu có upload mới
        if ($request->hasFile('image')) {
            $imageName = $product->slug . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('products', $imageName, 'public');
            $product->update(['image' => $imageName]);
        }

        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
    }

}
