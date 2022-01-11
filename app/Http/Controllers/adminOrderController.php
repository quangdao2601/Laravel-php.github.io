<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminOrderController extends Controller
{
    function list(){
        return view('admin.order.list');
    }
}
