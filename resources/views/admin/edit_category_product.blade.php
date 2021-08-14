
{{--ngày tạo :13082021--}}
{{--người tạo vũ Văn diệu--}}
{{--Nội dung : dùng để chỉnh sửa thương hiệu sản phẩm admin--}}
@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Cập nhật danh mục sản phẩm
        </header>
        <div class="panel-body">
            @foreach($edit_category_product as $key => $edit_value)
            <div class="position-center">
                <?php
                $messenger = Session::get('messenger');
                if ($messenger){
                    echo '<div  align="center" style="color: red">'.$messenger.'</div>';
                    $messenger = Session::put('messenger',null);
                }
                ?>
                <form role="form" action="{{URL::to('update-category-product/'.$edit_value->category_id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text"  value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none" rows="8" type="text"name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả sản phẩm">
                            {{$edit_value->category_desc}}
                        </textarea>
                    </div>
                    <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật</button>
                </form>
            </div>
            @endforeach
        </div>
    </section>

</div>
@endsection

