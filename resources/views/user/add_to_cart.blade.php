

@extends('user.layouts.usertemplate');

@section('page_title')
Add To Cart > E-Hut
@endsection

@section('main-content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()-> get('message')}}
        </div>
    @endif
    <div class="col-12">
        <div class="box_main">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
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
                            <td><a href="{{route('removefromcart', $item->id)}}" class="btn btn-warning">Remove</a></td>
                        </tr>
                        @php
                            $total = $total + $item->price;
                        @endphp

                    @endforeach
                    <tr>
                            <td></td>
                            <td></td>
                            @if($total >0 )
                            <td>Total</td>
                            <td>{{$total}}</td>
                            <td><a href="{{route('checkout')}}" class="btn btn-primary">Checkout</a></td>
                            @endif
                    </tr>

                </table>
            </div>
        </div>
    </div>
    @endsection
