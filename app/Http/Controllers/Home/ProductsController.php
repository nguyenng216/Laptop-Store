<?php

namespace App\Http\Controllers\Home;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ✅ thêm dòng này
class ProductsController extends Controller
{
     public function index()
    {
    $viewData = [];
    $viewData["title"] = "Products -Online Store";
    $viewData["subtitle"] = "List of products";
    $viewData["products"] = Product::all();
    return view('products.index')->with("viewData", $viewData);
    }
    public function show($id){
        $viewData= [];
        $viewData['title'] = "Product Details" ;
        $viewData['content'] = "Detailed information about the selected product.";
        $viewData['footer'] = "© 2024 LaptopShop. All rights reserved.";
        $viewData['products'] = Product::findOrFail($id);
        return view('products.show') ->with("viewData", $viewData);
        
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $viewData= [];


        // Tìm sản phẩm có tên chứa từ khóa (không phân biệt hoa thường)
        $products = \App\Models\Product::where('name', 'LIKE', "%{$query}%")->get();
        $viewData['products'] = $products;
        $viewData['title'] = "Search Results";
        

        // Trả về view kết quả (ví dụ: search.blade.php)
        return view('products.search') ->with("viewData", $viewData);
    }
}   
