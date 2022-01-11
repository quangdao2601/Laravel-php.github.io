<?php

namespace App\Http\Controllers;

use App\customer;
use App\list_order;
use App\product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart()
    {

        return view('store.cart.cart');
    }

    function add(Request $request)
    {
        $info_product = product::find($request->id);

        Cart::add([
            'id' => $info_product->id,
            'name' => $info_product->name,
            'qty' => 1,
            'price' => $info_product->price,
            'options' => ['img_product' => $info_product->img_product, 'qty_max' => $info_product->qty]
        ]);

        return redirect('cart/list');
    }

    function delete(Request $request)
    {
        Cart::remove($request->rowId);
        return redirect('cart/list');
    }

    function destroy()
    {
        Cart::destroy();
        return redirect('cart/list');
    }

    function update(Request $request)
    {
        $data = $request->input('rowId');
        foreach ($data as $key => $val) {
            Cart::update($key, $val);
        }
        return redirect('cart/list');
    }

    function checkout()
    {


        return view('store.cart.checkout');
    }

    function reslove(Request $request)
    {
        $code = mt_rand(0, 1000000);
        $request->validate(
            [
                'address' => 'required|string',
                'phone' => 'required|string',
                'payment' => 'required',

            ],
            [
                'required' => 'không được bỏ trống :attribute',
            ],
            [
                'address' => 'địa chỉ giao hàng',
                'phone' => 'số điện thoại',
                'payment' => 'Hình thức thanh toán',
            ]
        );
        customer::create([
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'note' => $request->input('note'),
            'payment' => $request->input('payment'),
            'code' => $code,
            'qty' => Cart::count(),
            'total' => Cart::total()
        ]);
        foreach (Cart::content() as $product) {
            list_order::create([
                'id_customer' => Auth::user()->id,
                'id_product' => $product->id,
                'code' => $code,
                'qty' => $product->qty,
                'total' => $product->total
            ]);
        }
        Cart::destroy();

        return redirect('');
    }
}
