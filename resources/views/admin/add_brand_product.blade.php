{{--ngày tạo :13082021--}}
{{--người tạo vũ Văn diệu--}}
{{--Nội dung : dùng để thêm thương hiệu sản phẩm admin--}}

@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <div class="panel-body">

                <div class="position-center">
                    <?php
                    $messenger = Session::get('add');
                    if ($messenger){
                        echo '<div  align="center" style="color: red">'.$messenger.'</div>';
                        $messenger = Session::put('add',null);
                    }
                    ?>
                    <form role="form" action="{{URL::to('save-brand-product')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" rows="8" type="text"name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiện thị</label>
                            <select  name = "brand_product_status"class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection

