<?php

namespace App\Http\Controllers;

use App\post;
use App\post_cat;
use App\product_cat;
use App\product;
use Illuminate\Http\Request;

class adminPostController extends Controller
{
    function status_post($status)
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
    function list(Request $request)

    {
        $keyword = "";
        $list_action = [
            'delete' => "Xóa bài viết"
        ];
        if (!empty($request->input('q'))) {
            $keyword = $request->input('q');
        }
        if ($request->status == 'deleted') {
            $list_post = post::onlyTrashed()->where('title', 'LIKE', "%{$keyword}%")->paginate(5);
            $list_action = [
                'restore' => 'Khôi phục bài viết',
                'delete_for' => 'Xóa vĩnh viễn'
            ];
        } else {
            $list_post = post::where('title', 'LIKE', "%{$keyword}%")->paginate(4);
        }
        $post_active = post::count();
        $post_deleted = post::onlyTrashed()->count();
        foreach ($list_post as $post) {
            $post->status = $this->status_post($post->status);
            $cat = post_cat::where('id', $post->post_cat_id)->get();
            $post->cat_name = $cat['0']['name'];
        }
        return view('admin.post.list', compact('list_post', 'post_active', 'post_deleted', 'list_action'));
    }

    function add()
    {
        $list_cat_post = post_cat::all();
        $list_cat_post = $this->data_tree($list_cat_post, 0);
        return view('admin.post.add', compact('list_cat_post'));
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'desc' => "required|string|max:1000",
            'content' => "required|max:4000",
            'file' => 'required',
            'cat_id' => 'required',
        ], [
            'required' => 'Không được bỏ trống :attribute',
            'max' => 'Độ dài tối đa :max ký tự',

        ], [
            'title' => 'tiêu đề bài viết',
            'desc' => 'miêu tả ngắn ',
            'content' => 'nội dung bài viết',
            'file' => 'ảnh bài viết',
            'cat_id' => 'danh mục bài viết'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file;
            $img_post = $file->getclientoriginalname();
            $title = $request->input('title');
            $cat_id = $request->input('cat_id');
            $descc = $request->input('desc');
            $content = $request->input('content');
            $status = $request->input('status');
            post::create([
                'title' => $title,
                'img_post' => $img_post,
                'post_cat_id' => $cat_id,
                'descc' => $descc,
                'content' => $content,
                'status' => $status,
            ]);
            return  $file->move('public/uploads/post', $img_post) . redirect('admin/post/list')->with('status', 'Đã thêm sản phẩm thành công');
        }
    }
    function update(Request $request)
    {
        $info_post = post::find($request->id);
        $list_cat = post_cat::all();
        $list_cat = $this->data_tree($list_cat, 0);
        return view('admin/post/update', compact('info_post', 'list_cat'));
    }

    function reslove_update(Request $request)
    {
        $request->validate([
            'desc' => "required|string|max:1000",
            'content' => "required|max:4000",
            'cat_id' => 'required',
        ], [
            'required' => 'Không được bỏ trống :attribute',

            'max' => 'Độ dài tối đa :max ký tự',

        ], [
            'desc' => 'mô tả ngắn',
            'content' => 'nội dung bài viết',

            'cat_id' => 'danh mục bài viết'
        ]);
        $product = post::where('title', $request->input('title'))->update([

            'descc' => $request->input('desc'),
            'content' => $request->input('content'),

            'post_cat_id' => $request->input('cat_id'),
            'status' => $request->input('status')
        ]);
        return redirect('admin/post/list')->with('status', 'Đã cập nhật sản phẩm thành công');
    }
    function delete(Request $request)
    {
        $post = post::find($request->id);
        $post->delete();
        return redirect('admin/post/list');
    }
    function action(Request $request)
    {
        if (!empty($request->input('action')) && !empty($request->input('list_check'))) {
            if ($request->input('action') == 'delete') {
                post::destroy($request->input('list_check'));
                return redirect('admin/post/list')->with('status', 'Đã xóa thành công');
            } else {
                if ($request->input('action') == 'restore') {
                    post::onlyTrashed()->whereIn('id', $request->input('list_check'))->restore();
                    return redirect('admin/post/list')->with('status', 'Đã khôi phục sản phẩm');
                } else {
                    post::onlyTrashed()->whereIn('id', $request->input('list_check'))->forceDelete();
                    return redirect('admin/post/list')->with('status', 'Đã xóa sản phẩm thành công');
                }
            }
        } else {
            return redirect('admin/post/list')->with('status', 'Vui lòng chọn bản ghi và action để thực thi');
        }
    }
}
