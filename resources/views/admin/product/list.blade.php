@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="{{url('admin/product/list')}}">
                    <input type="text" class="form-control form-search" name="q" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{url('admin/product/action')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="analytic">
                    <a href="{{request()->fullurlwithquery(['status'=>'active'])}}" class="text-primary">Hoạt động<span class="text-muted">({{$product_active}})</span></a>
                    <a href="{{request()->fullurlwithquery(['status'=>'deleted'])}}" class="text-primary">Đã xóa<span class="text-muted">({{$product_deleted}})</span></a>

                </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="action">
                        <option>Chọn</option>
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
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if($list_product->total()>0)
                        @php
                        $count=0;
                        @endphp
                        @foreach($list_product as $product)
                        <tr class="">
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{$product->id}}">
                            </td>
                            <td>{{$count}}</td>
                            <td style="width:10%"><img class="img-fluid" src="{{asset('uploads/product').'/'.$product->img_product}}" alt=""></td>
                            <td><a href="#">{{$product->name}}</a></td>
                            <td>{{number_format($product->price)}}.đ</td>
                            <td>{{$product->qty}}</td>
                            <td>{{$product->cat_name}}</td>
                            <td>{{$product->created_at}}</td>
                            <td><span class="">{{$product->status}}</span></td>
                            @if(request()->status != 'deleted')
                            <td>
                                <a href="{{route('update_product',$product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('delete_product',$product->id)}}" onclick="return confirm('Chắn chắn bạn muốn xóa sản phẩm này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                            @endif
                        </tr>
                        @php
                        $count++;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="10">Không có sản phẩm nào</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{$list_product->links()}}

            </div>
        </form>
    </div>
</div>
@endsection