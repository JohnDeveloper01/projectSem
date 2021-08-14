<?php
//Ngày tạo 12/8/2021
//Người tạo vũ văn diệu
//Nội dung : điều khiển danh sách thương hiệu trong admin
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class BrandProductController extends Controller
{
    // hiển thị trang thêm thông tin
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }
    // trả về tất cả bản ghi
    public function all_brand_product(){
        $all_brand_product = DB::table('tbl_brand') ->get();
        $maneger_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $maneger_brand_product);
    }
    //thương hiệu
    public function save_brand_product(Request $request){
        //lấy tất cả dữ liệu trên database -> so sánh với dữ liệu add vào
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        //insert data lên database
        DB::table('tbl_brand')->insert($data);
        //hiển thị thông báo thêm thành công
        Session::put('add','Thêm thương hiệu thành công');

        return Redirect::to('/add-brand-product');
    }
    //kích hoạt thương hiệu
    public function unactive_brand_product($brand_product_id){
        DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->update(['brand_status'=>1]);
        Session::put('messenger',' Kích hoạt thành thương hiệu công');
        return Redirect::to('all-brand-product');
    }
    //ẩn thương hiệu
    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand')
            ->where('brand_id', $brand_product_id)
            ->update(['brand_status'=>0]);
        Session::put('messenger','  Không kích hoạt thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    //cập nhật thuong hiệu
    public function edit_brand_product($brand_product_id){
        $edit_brand_product = DB::table('tbl_brand') ->where('brand_id',$brand_product_id)->get();
        $maneger_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $maneger_brand_product);
    }
    //gửi post lên để cập nhật
    public function update_brand_product($brand_product_id,Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('messenger','  Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    //XÓA thương hiệu
    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('messenger','  Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
}

