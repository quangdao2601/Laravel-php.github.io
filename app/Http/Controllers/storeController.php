<?php

namespace App\Http\Controllers;

use App\product;
use App\product_cat;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class storeController extends Controller
{
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

    function index(Request $request)
    {
        // $list_product= product::where('status', 1)->get();
        $list_cat_parent = product_cat::where('cat_parent', 0)->get();
        $list_cat = product_cat::all();
        $count = 0;
        $list_product = [];
        foreach ($list_cat_parent as $item) {
            $cats = $this->data_tree($list_cat, $item->id);
            $list_product["{$count}"] = [];
            $list_product["{$count}"]["name"] = $item["name"];
            foreach ($cats as $cat) {
                $list_id[] = $cat->id;
            }
            $list_product["{$count}"]["products"] = product::whereIn('product_cat_id', $list_id)->where('status', 1)->get();
            $list_id = [];
            $count++;
        }

        return view('store.index', compact('list_product'));
    }

    function detail(Request $request)
    {
        $info_product = product::find($request->id);
        $list_product_relevant = product::where('product_cat_id', $info_product->product_cat_id)->get();
        return view('store.detail', compact('info_product', 'list_product_relevant'));
    }

    function ajax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = product::where('name', 'LIKE', "%{$query}%")
                ->get();

            $s = "";
            foreach ($data as $product) {
                $s .= "  <li >  
               <div class='img-product '><a href='http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/product/detail/" . $product->id . "'><img src='http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/public/uploads/product/" . $product->img_product . "' alt='' ></a></div>
               <div class='more-info' >
               <a href='http://localhost:8080/unitop.vn/back-end/lavarel/project/smartkey/product/detail/" . $product->id . "'> <p>" . $product->name . "</p></a>
               <span class='price-new'>" . number_format($product->price) . "đ</span>
               <span class='price-old'>" . number_format($product->old_price) . "đ</span>
               </div>
           </li>";
            }
            $output = '<h1>Sản phẩm gợi ý</h1><ul class="list-seach ">' . $s . '</ul>';
            echo $output;
        }
    }

    function product(Request $request)
    {
        $list_cat = product_cat::all();
        $list_cat = $this->data_tree($list_cat, $request->id);
        $list_product = [];
        $count = 0;
        foreach ($list_cat as $cat) {
            $list_product["{$count}"]['name'] = $cat->name;
            $list_product["{$count}"]['product'] = product::where('product_cat_id', $cat->id)->get();
            $count++;
        }
        
        return view('store.product',compact('list_product'));
    }
}
