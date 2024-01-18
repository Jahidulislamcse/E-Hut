<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index(Request $request){

        $search = $request['search'] ?? "";

        if ($search != ""){
            $allproducts = Product::where('product_name', 'LIKE', "%$search%")->get();
        }
        else {
            $allproducts = Product::all();
        }
        return view('user.layouts.home', compact('allproducts', 'search'));
    }

    public function Dashboard(){
        return view('user.layouts.home');
    }
}
