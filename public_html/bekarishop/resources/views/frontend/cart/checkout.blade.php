@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title> Checkout - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')
<?php
    $user_id = Session::get('user_id');
    $coupone_code = Session::get('coupone_code');
    $discount = Session::get('discount');
    $coupon_percentage = Session::get('coupon_percentage');

    $user = App\Models\User::where('id', $user_id)->first();
?>

    <main class="pattern_2">
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->checkout_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Checkout</h1>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>


        <form action="{{route('place-order')}}" method="post">
            @csrf

            <div class="container margin_60_40">
                <div class="row justify-content-center">

                    <div class="col-xl-6 col-lg-8">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ol>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: 12px">{{ $error }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif

                        <div class="box_booking_2 style_2">
                            <div class="head">
                                <div class="title">
                                    <h3>Personal Details</h3>
                                </div>
                            </div>
                            <!-- /head -->
                        
                            <div class="main">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" placeholder="First Name" name="fname" value="{{$user->fname ?? old('fname')}}" requried>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" placeholder="Last Name" name="lname" value="{{$user->lname ?? old('lname')}}" requried>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="form-control" placeholder="Email Address" name="email" value="{{$user->email ?? old('email') }}" requried>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" placeholder="Phone"  name="phone" value="{{$user->phone ?? old('phone') }}" requried>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <select class="form-control area_id" name="area_id" id="area_select2" onchange="GetShippingCharge(this.value)" requried>
                                                    <option value="">Select a Area...</option>
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input class="form-control zipcode" placeholder="0123" name="postcode" value="{{$user->postcode ?? ''}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Full Address</label>
                                    <input class="form-control" placeholder="Full Address" name="address" value="{{$user->address ?? old('address')}}" requried>
                                </div>

                                <div class="form-group">
                                    <label>Urgent ?</label>
                                    
                                    <br>
                                   
                                    
                                    <select class="" name="isUrgent" class="isUrgent" onchange="getUrgentCharge(this.value)" requried>
                 
                                           <option value="yes">Yes</option>  
                                            <option value="no" selected>No</option>  
                                    </select>

                                    
                                    

                                </div>

                                @if(!$user_id)


                                <div class="form-group collapsePassword">
                                    <div class="row">
                                        <div class="col-lg-6 togglePassword">
                                            <input type="checkbox" name="checkbox" id="createaccount">
                                            <label class="form-check-label label_info" for="createaccount"><span>Create an account?</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group collapsePassword" style="display: none">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" name="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>

                        </div>

                        <!-- /box_booking -->
                        <div class="box_booking_2 style_2">
                            <div class="head">
                                <div class="title">
                                    <h3>Payment Method</h3>
                                </div>
                            </div>
                            <!-- /head -->
                            <div class="main">

                                @foreach($payment_methods as $method)
                                <div class="payment_select">
                                    @if($method->slug == 'cash-on-delivery')
                                        <label class="container_radio hide-transaction"  data-id="{{ $method->id  }}">{{$method->title}}
                                            <input type="radio" value="{{$method->title}}" checked name="payment_method">
                                            <span class="checkmark"></span>
                                        </label>
                                        <i class="icon_wallet"></i>

                                    @else
                                        <label class="container_radio show-transaction"  data-id="{{ $method->id  }}">{{$method->title}}
                                            <input type="radio" value="{{$method->title}}"  name="payment_method">
                                            <span class="checkmark"></span>
                                        </label>
                                        <i class="icon_wallet"></i>
                                    @endif
                                </div>
                                @endforeach

                                <div id="TransactionID" style="display: none;">

                                    <div id="payment_details">

                                    </div>

                                    <br>

                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse">Type Your Transaction Id</label>
                                    <input type="text" class="form-control" name="transaction_id" placeholder="Transaction ID">
                                </div>

                            </div>

                        </div>
                        <!-- /box_booking -->
                    </div>
                    <!-- /col -->
                    <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
                        <div class="box_booking">
                            <div class="head">
                                <h3>Order Summary</h3>
                            </div>
                            <!-- /head -->
                            <div class="main">
                                <ul class="clearfix">
                                    @foreach($contents as $content)
                                    @if($content->rowId)
                                        <input type="hidden" name="rowid[]" value="{{$content->rowId}}">
                                    @endif
                                    <li>{{$content->qty}}x {{ Str::limit($content->name, 40) }}<span>৳ {{$content->price}}</span></li>
                                    @endforeach
                                </ul>
                                
                                <ul class="clearfix">
                                    <li>Subtotal<span>৳ <span id="checkout_sub_total">{{round($sub_total)}}</span></span></li>

                                    @if($discount)
                                    <li>Discount({{$coupon_percentage}}%)<span>৳  <span id="checkout_discount">{{$discount ?? 0}}</span> </span></li>
                                    @endif

                                    <li>Delivery fee<span>৳<span class="area_shipping_charge">0</span></span></li>
                                    
                                    
                                    
                                    <li style="display: none" class="urgent_charge_li">Urgent charge<span>৳<span class="urgent_charge">0</span></span></li>


                                    <li class="total">Total<span>৳ <span id="checkout_total">{{round($total)}}</span></span></li>
                                </ul>
                                <button type="submit" class="btn_1 full-width mb_5">Order Now</button>
                                <div class="text-center"><small>Or Call Us at <strong>0432 48432854</strong></small></div>
                            </div>
                        </div>
                        <!-- /box_booking -->
                    </div>
                   
                </div>
                <!-- /row -->
            </div>
        </form>
        <!-- /container --> 
    </main>
    

    
    
    
    
    
    
    

@stop