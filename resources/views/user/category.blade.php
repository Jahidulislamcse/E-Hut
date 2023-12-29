@extends('user.layouts.usertemplate');

@section('page_title')
Category > E-Hut
@endsection

@section('main-content')
<h1>{{$category->category_name}} - ({{$category->product_count}})</h1>
<div class="fashion_section">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <h1 class="fashion_taital">{{$category->category_name}}</h1>
                     <div class="fashion_section_2">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h4 class="shirt_text">{{$product->product_name}}</h4>
                                        <p class="price_text">Price  <span style="color: #262626;">{{$product->price}}</span></p>
                                        <div class="tshirt_img"><img src="{{ asset($product->product_img) }}"></div>
                                        <div class="btn_main">
                                            <form action="{{route('add_product_to_cart', $product->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                <input type="hidden" value="{{$product->price}}" name="price">
                                                <input type="hidden" value="1" name="quantity">
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
@endsection
