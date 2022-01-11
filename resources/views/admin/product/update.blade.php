@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('admin/product/update_reslove')}}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" value="{{$info_product->name}}" readonly='readonly' name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" value="{{$info_product->price}}" name="price" id="name">
                            @error('price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="old-price">Giá cũ</label>
                            <input class="form-control" type="text" value="{{$info_product->old_price}}" name="old-price" id="old-price">
                            @error('old-price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="desc" class="form-control" id="intro" cols="30" rows="5">{{$info_product->desc}}</textarea>
                            @error('desc')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="intro" cols="30" rows="5">{{$info_product->content}}</textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="qty">Số lượng</label>
                    <input class="form-control" type="number" value="{{$info_product->qty}}" name="qty" id="qty" min="0">
                    @error('qty')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_id">
                        <option value="">Chon dnah muc</option>
                        @foreach($list_cat as $cat)
                        <option <?php
                                if ($cat->id == $info_product->product_cat_id)
                                    echo "selected='selected'"
                                ?> value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                    @error('cat_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <label for="">Trạng thái</label>
                <div class="form-group">
                    <select class="form-control" name="status" id="">
                        <option value="1">Đã Đăng</option>
                        <option value="2">Chờ duyệt</option>
                    </select>
                </div>


                <input type="submit" name="btn-update" value="Cap Nhat" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection