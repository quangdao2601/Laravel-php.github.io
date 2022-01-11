<?php

namespace App\Http\Controllers;

use App\intermediary_product;

use App\product_cat;
use App\product;
use Illuminate\Http\Request;

class adminProductController extends Controller
{
    function status_product($status)
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
            'delete' => "Xóa sản phẩm"
        ];
        if (!empty($request->input('q'))) {
            $keyword = $request->input('q');
        }
        if ($request->status == 'deleted') {
            $list_product = product::onlyTrashed()->where('name', 'LIKE', "%{$keyword}%")->paginate(5);
            $list_action = [
                'restore' => 'Khôi phục sản phẩm',
                'delete_for' => 'Xóa vĩnh viễn'
            ];
        } else {
            $list_product = product::where('name', 'LIKE', "%{$keyword}%")->paginate(4);
        }
        $product_active = product::count();
        $product_deleted = product::onlyTrashed()->count();
        foreach ($list_product as $product) {
            $product->status = $this->status_product($product->status);
            $cat = product_cat::where('id', $product->product_cat_id)->get();
            $product->cat_name = $cat['0']['name'];
        }

        return view('admin.product.list', compact('list_product', 'product_active', 'product_deleted', 'list_action'));
    }

    function add()
    {
        $list_cat_product = product_cat::all();
        $list_cat_product = $this->data_tree($list_cat_product, 0);
        return view('admin.product.add', compact('list_cat_product'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200|unique:products',
            'price' => 'integer|required',
            'old-price'=>'integer|required',
            'desc' => "required|string|max:2000",
            'content' => "required|max:5000",
            'qty' => "required",
            'file' => 'required',
            'cat_id' => 'required',
        ], [
            'required' => 'Không được bỏ trống :attribute',
            'integer' => ':attribute phải là số nguyên',
            'max' => 'Độ dài tối đa :max ký tự',
            'unique' => ':attribute đã tồn tại trên hệ thống',

        ], [
            'name' => 'tên sản phẩm',
            'price' => 'Gía sản phẩm',
            'old-price'=>'Gía cũ',
            'desc' => 'miêu tả ngắn ',
            'content' => 'nội dung sản phẩm',
            'qty' => 'số lượng sản phẩm',
            'file' => 'ảnh sản phẩm',
            'cat_id' => 'danh mục sản phẩm'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file;
            $img_product = $file->getclientoriginalname();
            $name = $request->input('name');
            $price = $request->input('price');
            $qty = $request->input('qty');
            $cat_id = $request->input('cat_id');
            $desc = $request->input('desc');
            $content = $request->input('content');
            $status = $request->input('status');
            $old_price=$request->input('old-price');
            product::create([
                'name' => $name,
                'img_product' => $img_product,
                'price' => $price,
                'qty' => $qty,
                'product_cat_id' => $cat_id,
                'desc' => $desc,
                'content' => $content,
                'status' => $status,
                'old_price'=>$old_price,
            ]);
            return  $file->move('public/uploads/product', $img_product) . redirect('admin/product/list')->with('status', 'Đã thêm sản phẩm thành công');
        }
    }
    function update(Request $request)
    {
        $info_product = product::find($request->id);
        $list_cat = product_cat::all();
        return view('admin/product/update', compact('info_product', 'list_cat'));
    }

    function reslove_update(Request $request)
    {
        $request->validate([
            'price' => 'required|integer',
            'old-price'=>'required|integer',
            'desc' => "required|string|max:2000",
            'content' => "required|max:4000",
            'qty' => "required",
            'cat_id' => 'required',
        ], [
            'required' => 'Không được bỏ trống :attribute',
            'integer' => ':attribute phải là số nguyên',
            'max' => 'Độ dài tối đa :max ký tự',

        ], [
            'price' => 'Gía sản phẩm',
            'desc' => 'miêu tả ngắn ',
            'content' => 'nội dung sản phẩm',
            'qty' => 'số lượng sản phẩm',
            'cat_id' => 'danh mục sản phẩm',
            'old-price'=>'giá cũ'
        ]);
        $product = product::where('name', $request->input('name'))->update([
            'price' => $request->input('price'),
            'desc' => $request->input('desc'),
            'old_price'=>$request->input('old-price'),
            'content' => $request->input('content'),
            'qty' => $request->input('qty'),
            'product_cat_id' => $request->input('cat_id'),
            'status' => $request->input('status')
        ]);
        return redirect('admin/product/list')->with('status', 'Đã cập nhật sản phẩm thành công');
    }
    function delete(Request $request)
    {
        $product = product::find($request->id);
        $product->delete();
        return redirect('admin/product/list');
    }
    function action(Request $request)
    {
        if (!empty($request->input('action')) && !empty($request->input('list_check'))) {
            if ($request->input('action') == 'delete') {
                product::destroy($request->input('list_check'));
                return redirect('admin/product/list')->with('status', 'Đã xóa thành công');
            } else {
                if ($request->input('action') == 'restore') {
                    product::onlyTrashed()->whereIn('id', $request->input('list_check'))->restore();
                    return redirect('admin/product/list')->with('status', 'Đã khôi phục sản phẩm');
                } else {
                    product::onlyTrashed()->whereIn('id', $request->input('list_check'))->forceDelete();
                    return redirect('admin/product/list')->with('status', 'Đã xóa sản phẩm thành công');
                }
            }
        } else {
            return redirect('admin/product/list')->with('status', 'Vui lòng chọn bản ghi và action để thực thi');
        }
    }
}
