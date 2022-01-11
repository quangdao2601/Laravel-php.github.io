<?php

namespace App\Http\Controllers;

use App\customer;
use App\list_order;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    function checkrole()
    {
        $role = Auth::user()->role;
        if ($role == '1') {
            return redirect('dashboard');
        } else {
            return redirect('');
        }
    }
    function dashboard()
    {
        $list_customer = customer::all();
        return view('admin.dashboard', compact('list_customer'));
    }
    function detail_order(Request $request)
    {
        $list_order = list_order::where('code', $request->code)->get();
        foreach ($list_order as $order) {
            $t = product::where('id', $order->id_product)->get();
            $order->name = $t[0]['name'];
        }



        return view('admin.detail_order',compact('list_order'));
    }
}
