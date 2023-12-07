<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(){
        return view('admin.allproduct');
    }
    public function AllProduct(){
        return view('admin.allproduct');
    }
    public function AddProduct(){
        return view('admin.addproduct');
    }
}
