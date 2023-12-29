@extends('user.layouts.usertemplate');

@section('page_title')
Checkout > E-Hut
@endsection

@section('main-content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()-> get('message')}}
        </div>
    @endif
<h2>Provide your shipping address</h2>
<div class="row">
    <div class="col-12">
        <div class="box_main">
            <form action="{{route('addshippinginfo')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number">
                </div>

                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" name="district">
                </div>

                <div class="form-group">
                    <label for="upozila">Upozila</label>
                    <input type="text" class="form-control" name="upozila">
                </div>

                <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" name="area">
                </div>

                <div class="form-group">
                    <label for="road">Road</label>
                    <input type="text" class="form-control" name="road">
                </div>

                <div class="form-group">
                    <label for="house_number">House Number</label>
                    <input type="text" class="form-control" name="house_number">
                </div>

                <input type="submit" value="Next" class="btn btn-primary">

            </form>
        </div>
    </div>
</div>



@endsection()
