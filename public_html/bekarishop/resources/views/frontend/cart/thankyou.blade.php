@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    $siteInfo = App\Models\Siteinfo::first();
    $site_image = App\Models\SiteImage::first();
    ?>
    <title> Complete Order - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')



    <main class="pattern_2">
        
        <div class="hero_single inner_pages background-image" data-background="url({{ asset('assets/frontend/') }}/img/hero_menu.jpg)">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Confirm Order</h1>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>

        <div class="container margin_60_40">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="box_booking_2">
                        <div class="head">
                            <div class="title">
                            <h3>{{$siteInfo->site_name}}</h3>
                            {{$siteInfo->address}} 
                        </div>
                        </div>
                        <!-- /head -->
                        <div class="main">
                            <div id="confirm">
                                <div class="icon icon--order-success svg add_bottom_15">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                        <g fill="none" stroke="#8EC343" stroke-width="2">
                                            <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                            <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                        </g>
                                    </svg>
                                </div>
                                <h3>Order Confirmed!</h3>
                                <!-- <p>Sit an meis aliquam, cetero inermis.</p> -->
                            </div>
                        </div>
                    </div>
                    <!-- /box_booking -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
        
    </main>



@stop
