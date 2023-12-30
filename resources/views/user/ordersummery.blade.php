@extends('user.layouts.usertemplate');

@section('page_title')
Order Summery > E-Hut
@endsection

@section('main-content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()-> get('message')}}
        </div>
    @endif

<div class="row">
    <div class="col-6">
        <div class="box_main">
            Delivery Information:
                <p>District: {{$shipping_info->district}}</p>
                <p>Upozila: {{$shipping_info->upozila}}</p>
                <p>Area: {{$shipping_info->area}}</p>
                <p>Road: {{$shipping_info->road}}</p>
                <p>House: {{$shipping_info->house}}</p>
                <p>Phone Number: {{$shipping_info->phone_number}}</p>
        </div>
    </div>

    <div class="col-6">
        <div class="box_main">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>

                    @php
                        $total = 0;
                    @endphp

                    @foreach ($cart_items as $item)
                        <tr>
                            @php
                                $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                $product_image = App\Models\Product::where('id', $item->product_id)->value('product_img');
                            @endphp

                            <td>{{$product_name}}</td>
                            <td><img src="{{ asset($product_image)}}" style="height:50px"></td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                        </tr>

                        @php
                            $total = $total + $item->price;
                        @endphp

                    @endforeach

                    <tr>
                            <td></td>
                            <td>Total</td>
                            <td>{{$total}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <form action="{{route('placeorder')}}" method="POST">
        @csrf

        <input type="submit" value="Confirm Order" class="btn btn-primary mr-3">
        <input type="submit" value="Cancel Order" class="btn btn-danger">
    </form>
</div>


@endsection
