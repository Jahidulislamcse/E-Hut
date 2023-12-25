<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function Category($id){
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('user.category', compact('category', 'products'));
    }
    public function SingleProduct($id, $slug){
        $allproducts = Product::latest()->get();
        $subcategory_id = Product::where('id', $id)->value('product_sub_category_id');
        $relatedproducts = Product::where('product_sub_category_id',  $subcategory_id)->latest()->get();
        $product = Product::findOrFail($id);
        return view('user.single_product', compact('product','allproducts', 'relatedproducts'));
    }
    public function AddToCart(){
        return view('user.add_to_cart');
    }
    public function Checkout(){
        return view('user.checkout');
    }
    public function UserProfile(){
        return view('user.user_profile');
    }
    public function NewRelease(){
        return view('user.new_release');
    }
    public function TodaysDeal(){
        return view('user.todays_deal');
    }
    public function CustomerService(){
        return view('user.customer_service');
    }
}
