<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;

class seachController extends Controller
{   
    function seach(){

    }
    function ajax(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = product::where('name', 'LIKE', "%{$query}%")
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '
               <li><a href="data/'. $row->id .'">'.$row->name_product.'</a></li>
               ';
           }
           $output .= '</ul>';
           echo $output;
       }
       return $request;
    }
}
