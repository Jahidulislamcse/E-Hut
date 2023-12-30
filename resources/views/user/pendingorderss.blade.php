@extends('user.layouts.userprofile_template')

@section('profilecontent')
Pending Orders
@endsection


@section('main-content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()-> get('message')}}
        </div>
    @endif

    <table class="table">
        <tr>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>price</th>
        </tr>
        @foreach($pending_orders as $order)
            @php
                $product_name = App\Models\Product::where('id', $order->product_id)->value('product_name');
                $product_image = App\Models\Product::where('id', $order->product_id)->value('product_img');
            @endphp

            <tr>
                <td>{{$product_name}}</td>
                <td><img src="{{ asset($product_image)}}" style="height:50px"></td>
                <td>{{$order->total_price}}</td>
            </tr>
        @endforeach
    </table>
@endsection
