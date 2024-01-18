<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.min.css') }}">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
<!-- Responsive-->
<link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
<!-- fevicon -->
<link rel="icon" href="{{ asset('home/images/fevicon.png" type="image/gif') }}" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="{{ asset('home/css/jquery.mCustomScrollbar.min.css') }}">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
<!-- font awesome -->
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--  -->
<!-- owl stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}">
<link rel="stylesoeet" href="{{ asset('home/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

@extends('admin.layouts.template')
@section('page_title')
All Product > E-Hut
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> All Product</h4>
    <!-- Bootstrap Table with Header - Light -->
    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()-> get('message')}}
                    </div>
                @endif

    <div class="card">
        <h5 class="card-header">Available Products</h5>

            <form action="" class="col-5" style="margin-left: auto">
                <div class="input-group">
                    <input type="search" name="search" class="form-control" value="{{$search}}" placeholder="Search product">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" style="background-color: #f26522; border-color:#f26522 ">
                        <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

                <div class="table-responsive text-nowrap" style="margin-top: 10px;">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($products as $product)
                      <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>
                            <img style="height: 100px;" src="{{asset($product->product_img)}}" alt="">
                            <br>
                            <a href="{{route('editproduct_image', $product->id)}}" class="btn btn-primary">Update Image</a>
                        </td>
                        <td>{{$product->price}}</td>

                        <td>
                            <a href="{{route('editproduct', $product->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('deleteproduct', $product->id)}}" class="btn btn-warning">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Bootstrap Table with Header - Light -->
</div>
@endsection
