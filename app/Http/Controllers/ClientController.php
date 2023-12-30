<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function Register(){
        return view('user.register');
    }



    public function History(){
        return view('user.history');
    }

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
        $user = Auth::id();
        $cart_items = Cart::where('user_id', $user)->get();
        return view('user.add_to_cart', compact('cart_items'));
    }
    public function AddProductToCart(Request $request){
        $product_price = $request->price;
        $product_quantity = $request->quantity;
        $price = $product_price * $product_quantity;

        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $product_quantity,
            'price' => $price
        ]);

        return redirect()->route('add_to_cart')->with('message','Product added to add to cart success with price' );
    }
    public function Checkout(){
        return view('user.checkout');
    }

    public function AddShippingInfo(Request $request){

        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'district' => $request->district,
            'upozila' => $request->upozila,
            'area' => $request->area,
            'road' => $request->road,
            'house_number' => $request->house_number,
        ]);

        return redirect()->route('ordersummery')->with('message','shipping address stored successfully' );
    }

    public function UserProfile(){
        return view('user.user_profile');
    }
    public function Ordersummery(){
        $user = Auth::id();
        $cart_items = Cart::where('user_id', $user)->get();
        $shipping_info = ShippingInfo::where('user_id', $user)->first();
        return view('user.ordersummery', compact('cart_items' , 'shipping_info'));
    }

    public function PlaceOrder(){
        $user = Auth::id();
        $cart_items = Cart::where('user_id', $user)->get();
        $shipping_info = ShippingInfo::where('user_id', $user)->first();

        foreach($cart_items as $item){
            Order::insert([
                'user_id' => $user,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price,
                'phone_number' => $shipping_info->phone_number,
                'district' => $shipping_info->district,
                'upozila' => $shipping_info->upozila,
                'area' => $shipping_info->area,
                'road' => $shipping_info->road,
                'house' => $shipping_info->house_number,
            ]);
            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

        ShippingInfo::where('user_id', $user)->delete();

        return redirect()->route('pendingorders')->with('message', 'Order has been placed successfully');
    }

    public function PendingOrders(){
        $user = Auth::id();
        $pending_orders = Order::where([['status', 'pending'],['user_id', $user]])->latest()->get();
        return view('user.pendingorderss', compact('pending_orders'));
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

    public function RemoveFromCart($id){
       Cart::findOrFail($id)->delete();
        return redirect()->route('add_to_cart')->with('message',' Item Removed From Cart Successfully');
    }

}

