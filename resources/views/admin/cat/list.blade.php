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
                    <form action="{{url($url_add)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name">
                            @error('name')
                            <p class="text text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            <select class="form-control" id="" name="cat_parent">
                                <option value="">Chọn danh mục</option>
                                <option value="0">Trống</option>
                                @if(!empty($list_cat))
                                @foreach($list_cat as $val)
                                <option value="{{$val->id}}">{{str_repeat('_',$val->level).$val->name}}</option>
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
                                <input class="form-check-input" type="radio" readonly="readonly" name="status" id="exampleRadios1" value="2" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Danh mục cha</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($list_cat))
                            @php $count=0;
                            @endphp
                            @foreach($list_cat as $value)
                            <tr>
                                <td scope="col">{{$count}}</td>
                                <td scope="col">{{str_repeat('_',$value->level).$value->name}}</td>
                                <td scope="col">{{$value->cat_parent}}</td>
                                <td scope="col">
                                    {{$value->status}}
                                </td>
                                <td scope="cpl">
                                    <a href="{{route($url_update,$value->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>

                                    <a href="{{route($url_delete,$value->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn chắc chắn muốn xóa danh mục và danh mục con ??')" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @php
                            $count++;
                            @endphp
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">Không có danh mục nào</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection