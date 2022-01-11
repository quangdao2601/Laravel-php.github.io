<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
// Route::get('', function () {
//     return view('store.index');
// });

Route::get('', 'storeController@index');



Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


// chi tiết sản phẩm
Route::get('product/detail/{id}', 'storeController@detail')->name('product_detail');

// gio hang
Route::get('cart/list', 'CartController@cart')->name('cart');

// them sam pham vao gio hang
Route::get('cart/add/{id}', 'CartController@add')->name('add_product');

// xoa san pham khoi gio hang
Route::get('cart/delete/{rowId}', 'CartController@delete')->name('cart_delete_product');

// xoa toan bo gio hang
Route::get('cart/destroy', 'CartController@destroy')->name('cart_destroy');

// cap nht gio hang
Route::post('cart/update', 'CartController@update')->name('cart_update');

// xu ly ajax

 Route::get('search/name', 'storeController@ajax')->name('ajax');


 Route::get('store/product/{id}','storeController@product')->name('product');


Route::middleware('auth')->group(function () {

    // thanh toan gio hang
    Route::get('cart/checkout', 'CartController@checkout')->name('checkout');

    // chi tiet don hang
    Route::get('admin/detail_order/{code}', 'adminController@detail_order')->name('detail_order');

    // xử lý sau khi đặt hàng
    Route::post('cart/reslove', 'CartController@reslove')->name('reslove');
    // CHECK ROLE
    Route::get('checkroke', 'adminController@checkrole')->name('home')->middleware('verified');

    // trang chủ admin
    Route::get('dashboard', 'adminController@dashboard');

    Route::get('reg', 'storeController@urlafterreg');

    // danh sách quản trị viên
    Route::get('admin/users/list', 'adminUsersController@list');

    // thêm thành viên 
    Route::get('admin/users/add', 'adminUsersController@add');

    // xử lý thêm thành viên
    Route::post('admin/users/store', 'adminUsersController@store');

    // xu ly xoa thanh vien
    Route::get('admin/users/delete/{id}', 'adminUsersController@delete')->name('delete_user');

    // xu ly cac action thanh vien
    Route::post('admin/users/action', 'adminUsersController@action');

    // cap nhat thong tin thanh vien
    Route::get('admin/users/update/{id}', 'adminUsersController@update')->name('update_user');

    //xu ly cap nhat thong tin thanh vien
    Route::post('admin/users/update_reslove', 'adminUsersController@update_reslove');

    // danh sách danh mục sản phẩm
    Route::get('admin/product/cat/list', 'adminCatController@list');

    // Thêm danh mục danh mục sản phẩm
    Route::post('admin/product/cat/add', 'adminCatController@add');

    // cập nhật dnah mục sản phẩm
    Route::get('amdin/product/cat/update/{id}', 'adminCatController@update')->name('update_product');

    // cập nhật dnah mục sản phẩm
    Route::post('admin/product/cat/update_reslove', 'adminCatController@update_reslove');

    // Xóa danh mục
    Route::get('admin/product/cat/delete/{id}', 'adminCatController@delete')->name('delete_cat_product');



    // danh sách danh mục sản phẩm
    Route::get('admin/post/cat/list', 'adminCatController@list');

    // Thêm danh mục danh mục sản phẩm
    Route::post('admin/post/cat/add', 'adminCatController@add');

    // cập nhật dnah mục sản phẩm
    Route::get('amdin/post/cat/update/{id}', 'adminCatController@update')->name('update_post');

    // cập nhật dnah mục sản phẩm
    Route::post('admin/post/cat/update_reslove', 'adminCatController@update_reslove');

    // Xóa danh mục
    Route::get('admin/post/cat/delete/{id}', 'adminCatController@delete')->name('delete_cat_post');



    // sản phẩm

    // danh sach san pham
    Route::get('admin/product/list', 'adminProductController@list');

    // thêm sản phẩm 
    Route::get('admin/product/add', 'adminProductController@add');

    // xử lý thêm sản phẩm
    Route::post('admin/product/store', 'adminProductController@store');

    // cap nhat san pham
    Route::get('admin/product/update/{id}', 'adminProductController@update')->name('update_product');

    // xu ly cap nhat san pham
    Route::post('admin/product/update_reslove', 'adminProductController@reslove_update');

    // xao sản phẩm
    Route::get('admim/product/delete/{id}', 'adminProductController@delete')->name('delete_product');

    // xử lý action 
    Route::post('admin/product/action', 'adminProductController@action');






    // Bài viêt

    // danh sach san pham
    Route::get('admin/post/list', 'adminPostController@list');

    // thêm sản phẩm 
    Route::get('admin/post/add', 'adminPostController@add');

    // xử lý thêm sản phẩm
    Route::post('admin/post/store', 'adminPostController@store');

    // cap nhat san pham
    Route::get('admin/post/update/{id}', 'adminPostController@update')->name('update_post');

    // xu ly cap nhat san pham
    Route::post('admin/post/update_reslove', 'adminPostController@reslove_update');

    // xao sản phẩm
    Route::get('admim/post/delete/{id}', 'adminPostController@delete')->name('delete_post');

    // xử lý action 
    Route::post('admin/post/action', 'adminPostController@action');



    // order
    Route::get('admin/order/list', 'adminOrderController@list');

});
