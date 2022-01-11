@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật bài viết
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('admin/post/update_reslove')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề bài viết</label>
                    <input class="form-control" value="{{$info_post->title}}" readonly="readonly" type="text" name="title" id="title">


                </div>



                <div class="form-group">
                    <label for="intro">Miêu tả ngắn</label>
                    <textarea name="desc" class="form-control" id="intro" cols="" rows="10">{{$info_post->descc}}</textarea>
                    @error('desc')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>




                <div class="form-group">
                    <label for="intro">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="intro" name='content' cols="" rows="10">{{$info_post->content}}</textarea>
                    @error('content')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>




                <div class="form-group">
                    <label for="">Danh mục bài viết</label>
                    <select class="form-control" id="" name="cat_id">
                        <option value="">Chọn danh mục</option>
                        @if(!empty($list_cat))
                        @foreach($list_cat as $cat)
                        <option value="{{$cat->id}}">{{str_repeat('_',$cat->level).$cat->name}}</option>
                        @endforeach
                        @endif
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



                <input type="submit" name="btn-update" class="btn btn-primary" value="Cập nhật bài viết">
            </form>
        </div>
    </div>
</div>
@endsection