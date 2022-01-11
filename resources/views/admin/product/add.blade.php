@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('admin/product/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="name">
                            @error('price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="old-price">Giá cũ</label>
                            <input class="form-control" type="text" name="old-price" id="o;d-price">
                            @error('old-price')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="desc" class="form-control" id="intro" cols="" rows="10"></textarea>
                            @error('desc')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="intro" name='content' cols="" rows="10"></textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="qty">Số lượng</label>
                    <input class="form-control" type="number" name="qty" id="qty" min="1">
                    @error('qty')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>


                <label for="image">Anh sản phẩm </label>
                <input style="display: block;margin-bottom:10px" type="file" name="file" id="image">
                @error('file')
                <p class="text-danger">{{$message}}</p>
                @enderror




                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_id">
                        <option value="">Chọn danh mục</option>
                        @if(!empty($list_cat_product))
                        @foreach($list_cat_product as $cat)
                        <option value="{{$cat->id}}">{{str_repeat('_',$cat->level).$cat->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('cat_id')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                </div>



                <input type="submit" name="btn_add" value="Thêm mới">
            </form>
        </div>
    </div>
</div>
@endsection