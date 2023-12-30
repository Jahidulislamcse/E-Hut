@extends('admin.layouts.template')
@section('page_title')
Completed Orders > E-Hut
@endsection
@section('content')
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
            <th>Customer ID</th>
            <th>Phone Number</th>
            <th>District</th>
            <th>Upozila</th>
            <th>Area</th>
            <th>Road</th>
            <th>House</th>
            <th>Status</th>

        </tr>
        @foreach($delivered_orders as $order)
            @php
                $product_name = App\Models\Product::where('id', $order->product_id)->value('product_name');
                $product_image = App\Models\Product::where('id', $order->product_id)->value('product_img');
            @endphp

            <tr>
                <td>{{$product_name}}</td>
                <td><img src="{{ asset($product_image)}}" style="height:50px"></td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->user_id}}</td>
                <td>{{$order->phone_number}}</td>
                <td>{{$order->district}}</td>
                <td>{{$order->upozila}}</td>
                <td>{{$order->area}}</td>
                <td>{{$order->road}}</td>
                <td>{{$order->house}}</td>
                <td>{{$order->status}}</td>

            </tr>
        @endforeach
    </table>

@endsection
