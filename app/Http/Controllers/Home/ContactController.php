<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ✅ thêm dòng này
class ContactController extends Controller
{
    //
    public function index(){
        $viewData= [];
        $viewData['title'] = "Contact Us" ;
        $viewData['footer'] = " Contact Us \n © 2024 LaptopShop. All rights reserved.";
        return view('home.contact') ->with("viewData", $viewData);
    }

    
        public function submitForm(Request $request)
    {
        // Kiểm tra dữ liệu nhập
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        // (Tùy chọn) Gửi mail cho admin
       // Mail::to('admin@example.com')->send(new ContactMail($validated));

        // Trả về thông báo
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
