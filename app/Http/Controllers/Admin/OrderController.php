<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Index(){
        $pending_orders = Order::where('status', 'pending')->latest()->get();
        return view('admin.pendingorder', compact('pending_orders'));
    }
    public function CompletedOrder(){
        $delivered_orders = Order::where('status', 'delivered')->latest()->get();
        return view('admin.completedorder', compact('delivered_orders'));
    }
    public function CanceledOrder(){
        return view('admin.canceledorder');
    }
    public function Deliver($id){
        $status = 'delivered';
        Order::where('id', $id)->update(['status' => $status]);
        return redirect()->route('completedorder')->with('message',' Product delivered Successfully');

    }
}
