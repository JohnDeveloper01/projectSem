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
class ProductController extends Controller
{
    //Thêm sản phẩm
    public function add_product(){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    }
    // Liệt kê danh mục sản phẩm
    public function all_product(){
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.category_id','tbl_product.category_id')
            ->join('tbl_brand','tbl_brand.brand_id','tbl_product.brand_id')
            ->orderby('tbl_product.product_id','desc')
            ->get();
        $maneger_product = view('admin.all_product_2')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product_2', $maneger_product);
    }
    //thêm sản phẩm
    public function save_product(Request $request){
        //lấy tất cả dữ liệu trên database -> so sánh với dữ liệu add vào
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();//cắt tên file
            $name_image = current(explode('.',$get_name_image));//cắt file ví dụ : iphone12promax.jpg ->iphone12promax
            $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//đuôi mở rộng
            $get_image->move('public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('messenger','Thêm sản phẩm thành công');

            return Redirect::to('/all-product');
        }
        $data['product_image'] = '';
        //insert data lên database
        DB::table('tbl_product')->insert($data);
        //hiển thị thông báo thêm thành công
        Session::put('messenger','Thêm sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //  ẩn sản phẩm
    public function unactive_product($product_id){
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status'=>1]);
        Session::put('messenger',' Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //hiện sản phẩm
    public function active_product($product_id){
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status'=>0]);
        Session::put('messenger','  Không kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //cập nhật thuong hiệu
    public function edit_product($product_id){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $maneger_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $maneger_product);
    }
    //gửi post lên để cập nhật
    public function update_product($product_id,Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();//cắt tên file
            $name_image = current(explode('.',$get_name_image));//cắt file ví dụ : iphone12promax.jpg ->iphone12promax
            $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//đuôi mở rộng
            $get_image->move('public/upload/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('messenger','Cập nhật sản phẩm thành công');

            return Redirect::to('/all-product');
        }
        //insert data lên database
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        //hiển thị thông báo thêm thành công
        Session::put('messenger','Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //XÓA sản phẩm
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('messenger','  Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }
}


