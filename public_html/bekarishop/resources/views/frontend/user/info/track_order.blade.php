@extends('frontend.layouts.app')
@section('content')


<?php 
    $user_id = Session::get('user_id');
    $orders = App\Models\Order::where('customer_id', $user_id)->get();
?>


    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset('assets/frontend/') }}/img/hero_menu.jpg)">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>My Account</h1>
                            <!-- <p>Order food with home delivery or take away</p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->

        <!-- /filters_full -->

        <div class="page-content pt-150 pb-150 margin_60_40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-menu">

                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link " id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('logout')}}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">
                                    <div class="tab-pane fade " id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Hello {{$user->fname ?? ''}} {{$user->lname ?? ''}}! </h3>
                                            </div>
                                            <div class="card-body">
                                                <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br> manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                                            </div>
                                        </div>
                                    </div>


                                    @include('frontend.user.info.orders')


                                    <div class="tab-pane fade active show" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Your order status</h3>
                                            </div>
                                            <div class="card-body contact-from-area">

                                                <div class="row">
                                                    
                                                    <div class="col-md-12">
                                                        

                                                        @if($order)                   
                                                            @if($order->status == 0)
                                                                <img src="{{ asset('assets/frontend/') }}/assets/imgs/shop/pending.jpg" alt="">
                                                            @endif

                                                            @if ($order->status == 1)
                                                                <img src="{{ asset('assets/frontend/') }}/assets/imgs/shop/processing.jpg" alt="">
                                                            @endif

                                                            @if ($order->status == 2)
                                                                <img src="{{ asset('assets/frontend/') }}/assets/imgs/shop/success.jpg" alt="">
                                                            @endif

                                                            @if ($order->status == 3) 
                                                                <img src="{{ asset('assets/frontend/') }}/assets/imgs/shop/canceled.jpg" alt="">
                                                            @endif
                                                        @else
                                                        <h1>No Order Found !</h1>
                                                        @endif

                                                    </div>
                                                </div>

    
                                            </div>
                                        </div>
                                    </div>


                                    @include('frontend.user.info.address')
                                    @include('frontend.user.info.account_details')

                                    
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- /filters -->




        <div class="container margin_60_40">


            <!-- /row -->
        </div>
        <!-- /container -->

    </main>
    <!-- /main -->











@stop