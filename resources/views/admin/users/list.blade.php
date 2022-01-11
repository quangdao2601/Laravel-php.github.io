@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">

    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">

                <form action="">
                    <!-- @csrf -->
                    <input type="" class="form-control form-search" name="q" value="{{request()->input('q')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>

            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullurlwithquery(['status'=>'active'])}}" class="text-primary">Hoạt động<span class="text-muted">({{$user_active}})</span></a>
                <a href="{{request()->fullurlwithquery(['status'=>'deleted'])}}" class="text-primary">Đã xóa<span class="text-muted">({{$user_deleted}})</span></a>
            </div>
            <form action="{{url('admin/users/action')}}" method="POST">
                @csrf
                <div class="form-action form-inline py-3">

                    <select class="form-control mr-1" id="" name="action">
                        <option value="">Chọn</option>
                        @foreach($list_action as $key=>$val)
                        <option value="{{$key}}">{{$val}}</option>
                        @endforeach

                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">

                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">Stt</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Quyền</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count=0;
                        @endphp
                        @if($users->total() > 0)
                        @foreach($users as $user)
                        <tr>
                            <td>
                                @if ($user->id != Auth::user()->id)
                                <input type="checkbox" name="list_check[]" value="{{$user->id}}">

                                @endif
                            </td>
                            <th scope="row">{{$count}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>Admintrator</td>
                            <td>{{$user->created_at}}</td>

                            <td>
                                <a href="{{route('update_user',$user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                @if ($user->id != Auth::user()->id)
                                <a href="{{route('delete_user',$user->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" onclick="return confirm('Bạn chắc chắn muốn xóa thành viên này ??')" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                        @php
                        $count++;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text text-success">Không có thành viên nào trong hệ thống</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </form>
            {{$users->links()}}

        </div>
    </div>
</div>
@endsection