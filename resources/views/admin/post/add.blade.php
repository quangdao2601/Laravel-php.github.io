@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('admin/post/store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="title" id="title">
                    @error('title')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="intro">Miêu tả ngắn</label>
                    <textarea name="desc" class="form-control" id="intro" cols="" rows="10"></textarea>
                    @error('desc')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>




                <div class="form-group">
                    <label for="intro">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="intro" name='content' cols="" rows="10"></textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>



                <label for="image">Anh bài viết </label>
                <input style="display: block;margin-bottom:10px" type="file" name="file" id="image">
                @error('file')
                <p class="text-danger">{{$message}}</p>
                @enderror




                <div class="form-group">
                    <label for="">Danh mục bài viết</label>
                    <select class="form-control" id="" name="cat_id">
                        <option value="">Chọn danh mục</option>
                        @if(!empty($list_cat_post))
                        @foreach($list_cat_post as $cat)
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