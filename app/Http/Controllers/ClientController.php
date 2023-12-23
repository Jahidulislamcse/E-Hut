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
    public function SingleProduct(){
        return view('user.single_product');
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
