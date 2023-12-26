@extends('user.layouts.usertemplate');

@section('page_title')
User Profile > E-Hut
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box-main">
                <ul>
                    <li><a href="{{route('user_profile')}}">Dashboard</a></li>
                    <li><a href="{{route('pendingorders')}}">Pending Orders</a></li>
                    <li><a href="{{route('history')}}">History</a></li>
                    <li><a href="{{route('login')}}">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="box-main">
                @yield('profilecontent')
            </div>
        </div>
    </div>
</div>
@endsection
