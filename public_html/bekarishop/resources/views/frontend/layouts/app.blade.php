<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <?php
    $site_fav = App\Models\SiteImage::first();
    $info = App\Models\Siteinfo::first();
    ?>

    <meta charset="utf-8">
    @yield('title')
    @yield('head')
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="generator" content="nopCommerce" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($site_fav->favicon) }}" sizes="16x16">


    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('assets/frontend/') }}/css/vendors.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend/') }}/css/style.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('assets/frontend/') }}/css/wizard.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend/') }}/css/shop.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('assets/frontend/') }}/css/custom.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend/') }}/css/my-account.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend/') }}/css/blog.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/frontend/') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/') }}/css/ie7/ie7.css">

    {!! $info->google_anlytics_code !!}


</head>


<body>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=576163806785284&autoLogAppEvents=1" nonce="uVa0vDJG"></script>
<!-- 
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div> -->

    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div>

    <!-- /Page Preload -->
    
        @include('frontend.layouts.header')
        @yield('content')
        @include('frontend.layouts.footer')


    <script src="{{ asset('assets/frontend/') }}/js/common_scripts.min.js"></script>
    <script src="{{ asset('assets/frontend/') }}/js/slider.js"></script>
    <script src="{{ asset('assets/frontend/') }}/js/common_func.js"></script>
    <script src="{{ asset('assets/frontend/') }}/phpmailer/validate.js"></script>

     <script src="{{ asset('assets/frontend/') }}/js/specific_shop.js"></script>

    <!-- SPECIFIC SCRIPTS (wizard form) -->
    <script src="{{ asset('assets/frontend/') }}/js/wizard/wizard_scripts.min.js"></script>
    <script src="{{ asset('assets/frontend/') }}/js/wizard/wizard_func.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ asset('assets/frontend/') }}/js/sticky_sidebar.min.js"></script>
    <script src="{{ asset('assets/frontend/') }}/js/shop_order_func.js"></script>

    <script src="{{ asset('assets/frontend/') }}/js/bootstrap.bundle.min.js"></script>

    
    @include('frontend.layouts.js_script')


    
</body>

</html>
