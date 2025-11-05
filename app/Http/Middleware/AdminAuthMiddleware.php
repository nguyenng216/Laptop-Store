<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Middleware kiểm tra quyền admin trước khi cho qua route.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next  // callback middleware kế tiếp
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Nếu đã đăng nhập và role của user là 'admin' -> cho phép đi tiếp
        if (Auth::user() && Auth::user()->getRole() == 'admin') {
            return $next($request);
        } else {
            // Ngược lại: chuyển hướng về trang chủ (không có quyền)
            return redirect()->route('home.main');
        }
    }
}
