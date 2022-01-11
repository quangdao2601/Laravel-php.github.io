@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form>
                    @csrf
                    <input type="text" name="q" value="{{request()->input('q')}}" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{url('admin/post/action')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="analytic">
                    <a href="{{request()->fullurlwithquery(['status'=>'active'])}}" class="text-primary">Hoạt động<span class="text-muted">({{$post_active}})</span></a>
                    <a href="{{request()->fullurlwithquery(['status'=>'deleted'])}}" class="text-primary">Đã xóa<span class="text-muted">({{$post_deleted}})</span></a>

                </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="action">
                        <option value="">Chọn</option>
                        @foreach($list_action as $key=> $action)
                        <option value="{{$key}}">{{$action}}</option>
                        @endforeach

                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>

                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">Stt</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($list_post->total() >0)
                        @php
                        $count=0;
                        @endphp
                        @foreach($list_post as $post)
                        <tr>
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{$post->id}}">
                            </td>
                            <td scope="row">{{$count}}</td>
                            <td><img src="{{asset('uploads/post').'/'.$post->img_post}}" alt=""></td>
                            <td><a href="">{{$post->title}}</a></td>
                            <td>{{$post->cat_name}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->status}}</td>
                            @if(request()->status != 'deleted')
                            <td><a href="{{route('update_post',$post->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('delete_post',$post->id)}}" onclick="return confirm('Chắn chắn bạn muốn xóa bài viết này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                            @endif

                        </tr>
                        @php
                        $count++;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8">Không có bài viết nào</td>
                        </tr>
                        @endif



                    </tbody>
                </table>

            </div>
        </form>
    </div>
</div>
@endsection