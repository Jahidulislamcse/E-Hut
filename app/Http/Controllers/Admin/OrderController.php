<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function Index(){
        return view('admin.pendingorder');
    }
    public function CompletedOrder(){
        return view('admin.completedorder');
    }
    public function CanceledOrder(){
        return view('admin.canceledorder');
    }
}
