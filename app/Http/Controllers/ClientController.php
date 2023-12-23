<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function Category(){
        return view('user.category');
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
