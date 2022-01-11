@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                @if(session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action="{{url($url_update)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" value="{{$cat->name}}" type="text" name="name" id="name">
                            @error('name')
                            <p class="text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="" name="cat_parent">
                                <option value="">Chọn danh mục</option>
                                <option value="0">Trống</option>
                                @if(!empty($list_cats))
                                @foreach($list_cats as $val )
                                <option value="{{$val->id}}" <?php
                                                                if ($cat->cat_parent == $val->id) echo "selected='selected'"
                                                                ?>>{{str_repeat('_',$val->level).$val->name}}</option>
                                @endforeach
                                @endif

                            </select>
                            @error('cat_parent')
                            <p class="text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2">
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="1">
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cat_id">Cat_id</label>
                            <input class="form-control" value="{{$cat->id}}" readonly="readonly" type="text" name="cat_id" id="cat_id">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">

            </div>
        </div>
    </div>

</div>
@endsection