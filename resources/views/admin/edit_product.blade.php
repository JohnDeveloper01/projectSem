
{{--ngày tạo :13082021--}}
{{--người tạo vũ Văn diệu--}}
{{--Nội dung : dùng để thêm  sản phẩm admin--}}
@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
              Cập nhật sản phẩm
            </header>
            <div class="panel-body">

                <div class="position-center">
<!--                    --><?php
//                    $messenger = Session::get('add');
//                    if ($messenger){
//                        echo '<div  align="center" style="color: red">'.$messenger.'</div>';
//                        $messenger = Session::put('add',null);
//                    }
//                    ?>
                    @foreach($edit_product as $key => $pro)
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{--                        Tên sản phẩm--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                        </div>
                        {{--                        Tên sản phẩm--}}

                        {{--                        Giá Sản phẩm--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                        </div>
                        {{--                        Giá Sản phẩm--}}

                        {{--Hình ảnh--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file"  enctype ="multipart/form-data"name="product_image" class="form-control" id="exampleInputEmail1" >
                            <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}">
                        </div>
                        {{--Hình ảnh--}}

                        {{--Mô tả sản phẩm--}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" type="text"name="product_desc" class="form-control" id="exampleInputPassword1">{{$pro->product_desc}}</textarea>
                        </div>
                        {{--Mô tả sản phẩm--}}

                        {{--Nội dung sản phẩm--}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" type="text"name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Mô tả nội dung sản phẩm">{{$pro->product_content}}</textarea>
                        </div>
                        {{--Nội dung sản phẩm--}}
                        {{--                        danh mục sản phẩm -> category--}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select  name = "product_cate"class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    @if($cate->category_id==$pro->category_id)
                                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @else
                                        <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{--  kết thúc danh mục sản phẩm -> category--}}

                        {{--                        Bắt đầu thương hiệu sản phẩm--}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select  name = "product_brand"class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)
                                    @if($cate->category_id==$pro->category_id)
                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @else
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{--                        kết thúc thương hiệu sản phẩm--}}

                        {{--                        hiển thị sản phẩm--}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiện thị</label>
                            <select  name = "product_status"class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>
                        {{--                        kết thuc hiển thị--}}
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật</button>
                    </form>
                        @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection


