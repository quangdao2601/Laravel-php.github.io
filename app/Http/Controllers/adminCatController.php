<?php

namespace App\Http\Controllers;

use App\post_cat;
use App\product_cat;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class adminCatController extends Controller
{
    function status_cat($status)
    {
        $list_status = ['1' => 'Đã Đăng', '2' => 'Chờ duyệt'];
        return $list_status["{$status}"];
    }
    function data_tree($data, $parent_id, $level = 0)
    {
        $result = array();
        foreach ($data as $item) {
            if ($item["cat_parent"] == $parent_id) {
                $item["level"] = $level;
                $result[] = $item;
                $child = $this->data_tree($data, $item["id"], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    function list()
    {

        $url_current = url()->current();
        if ($url_current == "http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/admin/product/cat/list") {
            $url_add = "admin/product/cat/add";
            $url_update = "update_product";
            $url_delete = "delete_cat_product";
            $list_cat = product_cat::all();
            $list_cat = $this->data_tree($list_cat, 0);
            foreach ($list_cat as $cat) {
                $cat['status'] = $this->status_cat($cat->status);
            }
            return view('admin.cat.list', compact('list_cat', 'url_add', 'url_update', 'url_delete'));
        } else {
            $url_add = "admin/post/cat/add";
            $url_update = "update_post";
            $url_delete = "delete_cat_post";
            $list_cat = post_cat::all();
            $list_cat = $this->data_tree($list_cat, 0);
            foreach ($list_cat as $cat) {
                $cat['status'] = $this->status_cat($cat->status);
            }
            return view('admin.cat.list', compact('list_cat', 'url_add', 'url_update', 'url_delete'));
        }
    }
    function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100    ',
            'cat_parent' => 'required'
        ], [
            'required' => 'Không được bỏ trống :attribute',
            'min' => 'Tối thiểu :min ký tự',
            'max' => 'Tối đa :max ký tự'
        ], [
            'name' => 'Tên danh mục',
            'cat_parent' => 'Danh mục cha'
        ]);

        $url_current = url()->current();
        if ($url_current == "http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/admin/product/cat/add") {
            product_cat::create([
                'name' => $request->input('name'),
                'cat_parent' => $request->input('cat_parent'),
                'status' => $request->input('status')
            ]);
            return redirect('admin/product/cat/list')->with('status', 'Đã thêm danh mục thành công');
        } else {
            post_cat::create([
                'name' => $request->input('name'),
                'cat_parent' => $request->input('cat_parent'),
                'status' => $request->input('status')
            ]);
            return redirect('admin/post/cat/list')->with('status', 'Đã thêm danh mục thành công');
        }
    }

    function update(Request $request)
    {
        $url_current = url()->current();
        if (str::contains($url_current, "product")) {
            $url_update = "admin/product/cat/update_reslove";
            $cat = product_cat::find($request->id);
            $list_cat = product_cat::all();
            $list_cats = $this->data_tree($list_cat, 0);
            return view('admin.cat.update', compact('list_cats', 'cat', 'url_update'));
        } else {
            $url_update = "admin/post/cat/update_reslove";
            $cat = post_cat::find($request->id);
            $list_cat = post_cat::all();
            $list_cats = $this->data_tree($list_cat, 0);
            return view('admin.cat.update', compact('list_cats', 'cat', 'url_update'));
        }
    }

    function update_reslove(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'cat_parent' => 'required'
        ], [
            'required' => 'Không được bỏ trống :attribute',
            'min' => 'Tối thiểu :min ký tự',
            'max' => 'Tối đa :max ký tự'
        ], [
            'name' => 'Tên danh mục',
            'cat_parent' => 'Danh mục cha'
        ]);
        $url_current = url()->current();
        if (str::contains($url_current, "product")) {
            $cat = product_cat::where('id', $request->input('cat_id'))->update([
                'name' => $request->input('name'),
                'cat_parent' => $request->input('cat_parent'),
                'status' => $request->input('status')
            ]);
            return redirect('admin/product/cat/list')->with('status', 'Đã cập nhật thành công');
        } else {
            $cat = post_cat::where('id', $request->input('cat_id'))->update([
                'name' => $request->input('name'),
                'cat_parent' => $request->input('cat_parent'),
                'status' => $request->input('status')
            ]);
            return redirect('admin/post/cat/list')->with('status', 'Đã cập nhật thành công');
        }
    }
    function delete(Request $request)
    {
        $url_current = url()->current();
        if (Str::contains($url_current, 'product')) {
            $list_cat = product_cat::all();
            $list_cat_delete = $this->data_tree($list_cat, $request->id);
            $list_id = [];
            foreach ($list_cat_delete as $item) {
                $list_id[] = $item->id;
            }
            if (!empty($list_id)) {
                product_cat::destroy($list_id);
            }
            $cat_parent_delete = product_cat::find($request->id);
            $cat_parent_delete->delete();
            return redirect('admin/product/cat/list')->with('status', 'Đã xóa thành công');
        } else {
            $list_cat = post_cat::all();
            $list_cat_delete = $this->data_tree($list_cat, $request->id);
            foreach ($list_cat_delete as $item) {
                $list_id[] = $item->id;
            }
            if (!empty($list_id)) {
                post_cat::destroy($list_id);
            }

            $cat_parent_delete = post_cat::find($request->id);
            $cat_parent_delete->delete();
            return redirect('admin/post/cat/list')->with('status', 'Đã xóa thành công');
        }
    }
}
