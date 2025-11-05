<?php

namespace App\Http\Controllers\Home;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ✅ thêm dòng này
class HomeController extends Controller
{
    //
    public function index()
{
    $viewData = [];

    // Lấy tất cả danh mục
    $viewData['categories'] = Category::with('products')->get();

    // Lấy tất cả sản phẩm giảm giá
    $viewData['discount_products'] = Product::whereNotNull('discount_price')->get();

    $viewData['title'] = 'Home';

    return view('home.main')->with('viewData', $viewData);
}
    public function about(){
        $viewData= [];
        $viewData['title'] = "About Us" ;
        $viewData['footer'] = " About Us \n © 2024 LaptopShop. All rights reserved.";
        return view('home.about') ->with("viewData", $viewData);
    }
    public function blog(){
        $viewData= [];
        $viewData['title'] = "News Technology" ;
        $viewData['footer'] = "© 2024 LaptopShop Blog — Stay updated with the latest news, trends, and reviews in technology, laptops, and digital devices. All rights reserved.";
        return view('home.blog') ->with("viewData", $viewData);
    }

}
