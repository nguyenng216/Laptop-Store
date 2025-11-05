<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductsController;
use App\Http\Middleware\AdminAuthMiddleware;

Route::get('/' , 'App\Http\Controllers\Home\HomeController@index')->name('home.main');
Route::get('/about' , 'App\Http\Controllers\Home\HomeController@about')->name('home.about');
Route::get('/blog' , 'App\Http\Controllers\Home\HomeController@blog')->name('home.blog');
Route::get('/contact' , 'App\Http\Controllers\Home\ContactController@index')->name('home.contact');
Route::post('/contact/submit' , 'App\Http\Controllers\Home\ContactController@submitForm')->name('contact.submit');
Route::get('product/{id}' , 'App\Http\Controllers\Home\productsController@show')->name('product.show');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name("cart.index");
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name("cart.delete");
Route::post('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name("cart.add");

Route::get('/categories/{id}', 'App\Http\Controllers\CategoriesController@index')->name("categories.index");
Route::get('/search', 'App\Http\Controllers\Home\ProductsController@search')->name("products.search");
    
Route::middleware(['auth'])->group(function () {
    Route::get('/cart/purchase', 'App\Http\Controllers\CartController@showPurchase')->name("cart.purchase");
    Route::post('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name("myaccount.orders");
    Route::post('/my-account/{id}/update', 'App\Http\Controllers\CartController@updateQuantity')->name("cart.update");
    Route::post('/my-account/{id}/delete', 'App\Http\Controllers\CartController@remove')->name("cart.remove");

});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin' , 'App\Http\Controllers\Admin\AdminController@index')->name('admin.dashbroad');
    Route::get('/admin/products' , 'App\Http\Controllers\Admin\AdminController@createProducts')->name('admin.products');
    Route::post('/admin/product/store' , 'App\Http\Controllers\Admin\AdminController@store')->name('admin.product.store');
    Route::delete('/admin/product/delete/{id}' , 'App\Http\Controllers\Admin\AdminController@delete')->name('admin.product.delete');
    Route::get('/admin/products/edit/{id}', 'App\Http\Controllers\admin\AdminController@edit')->name('admin.product.edit');
    Route::put('/admin/products/update/{id}', 'App\Http\Controllers\admin\AdminController@update')->name('admin.product.update');
    Route::get('/admin/users', 'App\Http\Controllers\Admin\AdminUsersController@index')->name('admin.users');


    Route::get('/admin/categories', 'App\Http\Controllers\Admin\AdminCatogriesController@index')->name('admin.categories.index');
    Route::get('/admin/categories/createCatogy', 'App\Http\Controllers\Admin\AdminCatogriesController@create')->name('admin.categories.create');
    Route::post('/admin/categories', 'App\Http\Controllers\Admin\AdminCatogriesController@store')->name('admin.categories.store');
    Route::get('/admin/categories/{category}/editCatogy', 'App\Http\Controllers\Admin\AdminCatogriesController@edit')->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', 'App\Http\Controllers\Admin\AdminCatogriesController@update')->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', 'App\Http\Controllers\Admin\AdminCatogriesController@destroy')->name('admin.categories.destroy');



});

Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\AdminUsersController@index')->name('index');
    Route::get('/create','App\Http\Controllers\Admin\AdminUsersController@create')->name('create');
    Route::post('/', 'App\Http\Controllers\Admin\AdminUsersController@store')->name('store');
    Route::get('/{id}/edit', 'App\Http\Controllers\Admin\AdminUsersController@edit')->name('edit');
    Route::put('/{id}', 'App\Http\Controllers\Admin\AdminUsersController@update')->name('update');
    Route::delete('/{id}/destroy', 'App\Http\Controllers\Admin\AdminUsersController@destroy')->name('destroy');
    Route::patch('/{id}/toggle', 'App\Http\Controllers\Admin\AdminUsersController@userStatus')->name('userStatus');


});
Route::prefix('admin/oders')->name('admin.oders.')->group(function() {
    Route::get('/', 'App\Http\Controllers\Admin\AdminOderController@index')->name('index');
    Route::get('/show/{id}', 'App\Http\Controllers\Admin\AdminOderController@show')->name('show');
    Route::get('/edit/{id}', 'App\Http\Controllers\Admin\AdminOderController@edit')->name('edit');
    Route::put('/update/{id}', 'App\Http\Controllers\Admin\AdminOderController@update')->name('update');
    Route::delete('/destroy', 'App\Http\Controllers\Admin\AdminOderController@destroy')->name('destroy');

});
Auth::routes();
