@extends('user.layouts.usertemplate');

@section('page_title')
Single Product > E-Hut
@endsection

@section('main-content')
<div class="container">
    <div class="row">

        <div class="col-lg-4">
            <div class="box_main">
                <div class="tshirt_img"><img src="{{ asset($product->product_img) }}"></div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="box_main">
                <div class="product_info">
                    <h4 class="shirt_text text-left">{{$product->product_name}}</h4>
                    <p class="price_text text-left">Price  <span style="color: #262626;">{{$product->price}}</span></p>
                </div>

                <div class="product_details">
                    <p class="lead">{{$product->product_long_description}}</p>
                    <ul class="p-2 bg-light my-2">
                        <li>Category - {{$product->product_category_name}} </li>
                        <li>Sub Category - {{$product->product_sub_category_name}} </li>
                        <li>Available Quantity - {{$product->quantity}} </li>
                    </ul>
                </div>

                <div class="btn_main">
                    <form action="{{route('add_product_to_cart', $product->id)}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input class="form-control" type="number" min='1' max="{{$product->quantity}}" placeholder="0" name="quantity">
                        </div>
                        <br>
                        <input class="btn btn-warning" type="submit" value="Add to Cart">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="fashion_section">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <h1 class="fashion_taital">All Products</h1>
                     <div class="fashion_section_2">
                        <div class="row">
                            @foreach($relatedproducts as $product)
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h4 class="shirt_text">{{$product->product_name}}</h4>
                                        <p class="price_text">Price  <span style="color: #262626;">{{$product->price}}</span></p>
                                        <div class="tshirt_img"><img src="{{ asset($product->product_img) }}"></div>
                                        <div class="btn_main">
                                            <form action="{{route('add_product_to_cart', $product->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <input class="btn btn-warning" type="submit" value="Buy Now">
                                            </form>
                                            <div class="seemore_bt"><a href="{{route('single_product',[$product->id, $product->slug])}}">See More</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>
        </div>
</div>

</div>


@endsection
