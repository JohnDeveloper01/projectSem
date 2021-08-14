<?php
//Ngày tạo 12/8/2021
//Người tạo vũ văn diệu
//Nội dung : điều khiển danh sách sản phẩm trong category
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CategoryController extends Controller
{
    // hiển thị trang thêm thông tin
    public function add_category_product(){
        return view('admin.add_category_product');
    }
    // trả về tất cả bản ghi
    public function all_category_product(){
        $all_category_product = DB::table('tbl_category_product') ->get();
        $maneger_category_product = view('admin.all_product')->with('all_category_product',$all_category_product);

        return view('admin_layout')->with('admin.all_product', $maneger_category_product);
    }
    //thêm sản phẩm
    public function save_category_product(Request $request){
        //lấy tất cả dữ liệu trên database -> so sánh với dữ liệu add vào
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        //insert data lên database
        DB::table('tbl_category_product')->insert($data);
        //hiển thị thông báo thêm thành công
        Session::put('add','Thêm danh mục thành công');

        return Redirect::to('/add-category-product');
    }
    //kích hoạt danh mục sản phẩm
    public function unactive_category_product($category_product_id){
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update(['category_status'=>1]);
        Session::put('messenger',' Kích hoạt danh mục sản phẩm thành công');
       return Redirect::to('all-category-product');
    }
    //ẩn danh mục
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')
            ->where('category_id', $category_product_id)
            ->update(['category_status'=>0]);
        Session::put('messenger','  Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //cập nhật danh mục
    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('tbl_category_product') ->where('category_id',$category_product_id)->get();
        $maneger_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $maneger_category_product);
    }
    //gửi post lên để cập nhật
    public function update_category_product($category_product_id,Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('messenger','  Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    //XÓA SẢN PHẨM
    public function delete_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('messenger','  Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
}
