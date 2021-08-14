<?php
//{{--Ngày Tạo : 11/8/2021--}}
//{{--Người Tạo : Vũ Văn Diệu--}}
//{{--Nội dung:Route--}}
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProductController;
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
//trangchu
Route::get('/', [\App\Http\Controllers\HomeController::class,'index']);
Route::get('trang-chu', [\App\Http\Controllers\HomeController::class,'index']);
Route::get('/dashboard', function (){
    return view('admin.dashboard');
});
//đăng nhập admin
Route::get('/admin','AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@loginAdmin');
//đăng xuất admin
Route::get('/logout-admin','AdminController@logout_admin');

//category-prodcut
//thêm sản phẩm
Route::get('/add-category-product',[CategoryController::class,'add_category_product']);
//sửa danh mục
Route::get('/edit-category-product/{category_product_id}',[CategoryController::class,'edit_category_product']);
Route::post('/update-category-product/{category_product_id}',[CategoryController::class,'update_category_product']);
//xóa danh mục
Route::get('/delete-category-product/{category_product_id}',[CategoryController::class,'delete_category_product']);
//hiển thị danh sách sản phẩm
Route::get('/all-category-product',[CategoryController::class,'all_category_product']);
Route::post('/save-category-product',[CategoryController::class,'save_category_product']);
//cho phép hiển thị
Route::get('/unactive-category-product/{category_product_id}',[CategoryController::class,'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}',[CategoryController::class,'active_category_product']);

///Brand product
Route::get('/add-brand-product',[BrandProductController::class,'add_brand_product']);
//sửa thương hiệu
Route::get('/edit-brand-product/{brand_product_id}',[BrandProductController::class,'edit_brand_product']);
Route::post('/update-brand-product/{brand_product_id}',[BrandProductController::class,'update_brand_product']);
//xóa thương hiệu
Route::get('/delete-brand-product/{brand_product_id}',[BrandProductController::class,'delete_brand_product']);
//hiển thị danh sách thương hiệu
Route::get('/all-brand-product',[BrandProductController::class,'all_brand_product']);
Route::post('/save-brand-product',[BrandProductController::class,'save_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}',[BrandProductController::class,'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}',[BrandProductController::class,'active_brand_product']);

//PRODUCT
Route::get('/add-product',[ProductController::class,'add_product']);
//sửa sản phẩm
Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product']);
Route::post('/update-product/{product_id}',[ProductController::class,'update_product']);
//xóa sản phẩm
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);
//hiển thị danh sách sản phẩm
Route::get('/all-product',[ProductController::class,'all_product']);
Route::post('/save-product',[ProductController::class,'save_product']);

Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class,'active_product']);
