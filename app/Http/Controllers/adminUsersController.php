<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminUsersController extends Controller
{
    function list(Request $request)
    {

        $keyword = "";
        if (!empty($request->input('q'))) {
            $keyword = $request->input('q');
        }
        $list_action = [
            'delete' => "Xóa thành viên"
        ];
        if ($request->status == 'deleted') {

            $list_action = [
                'delete_for' => "Xóa vĩnh viễn",
                'restore' => "Khôi phục thành viên"
            ];
            $users = User::onlyTrashed()->where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        } else {
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }
        $user_deleted = User::onlyTrashed()->count();
        $user_active = User::all()->count();
        return view('admin.users.list', compact('users', 'user_deleted', 'user_active', 'list_action'));
    }

    function add()
    {
        return view('admin.users.add');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => " required|string|max:255|min:6",
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:32|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'password_confirm' => 'required|same:password'
        ], [
            'required' => "Không được bỏ trống :attribute",
            'min' => 'Độ dài ít nhất :min ký tự',
            'max' => 'Độ dài tối đa :max ký tự',
            'email' => ":attribute không đúng định dạng",
            'unique' => ':attribute đã tồn tại trong hệ thống',
            "regex" => ":attribute không đúng định dạng",
            'same' => ":attribute  không chính xác"
        ], [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'password_confirm' => 'Mật khẩu xác nhận'
        ]);
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect("admin/users/list")->with('status', 'Đã thêm thành viên thành công');
    }

    function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect('admin/users/list')->with('status', "Đã xóa thành viên thành công");
    }

    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if (!empty($list_check) && !empty($request->input('action'))) {
            if ($request->input('action') == 'delete') {
                User::destroy($list_check);
                return redirect('admin/users/list')->with('status', 'Đã xóa thành công');
            } else {
                if ($request->input('action') == 'delete_for') {
                    User::onlyTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/users/list')->with('status', "Đã xóa thành viên thành công");
                } else {
                    User::onlyTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/users/list')->with('status', "Đã khôi phục thành công");
                }
            }
        } else {
            return redirect('admin/users/list')->with('status', 'Vui lòng chọn bản ghi hoặc hành động muốn thao tác');
        }
    }

    function update(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.users.update', compact('user'));
    }

    function update_reslove(Request $request)
    {
        $request->validate([
            'name' => " required|string|max:255|min:6",
            'password' => 'required|string|min:8|max:32|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'password_confirm' => 'same:password'
        ], [
            'required' => "Không được bỏ trống :attribute",
            'min' => 'Độ dài ít nhất :min ký tự',
            'max' => 'Độ dài tối đa :max ký tự',
            'unique' => ':attribute đã tồn tại trong hệ thống',
            "regex" => ":attribute không đúng định dạng",
            'same' => ":attribute  không chính xác"
        ], [
            'name' => 'Họ và tên',
            'password' => 'Mật khẩu',
            'password_confirm' => 'Mật khẩu xác nhận'
        ]);
        $user = User::where('email', $request->email)->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('admin/users/list')->with('status', 'Cập nhật thông tin thành công');
    }
}
