<?php

    $categories = App\Models\Category::where('status', 1)->get();
    
    $main_categories = App\Models\Category::where('parent_id', '==', 0)
        ->where('status', 1)
        ->get();

    $sub_categories = App\Models\Category::where('parent_id', '!=', 0)
        ->where('status', 1)
        ->get();

    $site_image = App\Models\SiteImage::first();
    $page_categories = App\Models\Page_category::where('status', 1)
        ->take(4)
        ->get();

    $siteInfo = App\Models\Siteinfo::first();
    $social_link = App\Models\SiteSocialLink::first();
    $user_id = Session::get('user_id');
    $total_item = Cart::content()->count();
    $contents = Cart::content();

    $sub_total =  (float) str_replace(',', '', Cart::subtotal());
 


?>

    <header class="header clearfix element_to_stick">
        <div class="layer"></div><!-- Opacity Mask Menu Mobile -->
        <div class="container-fluid">
        <div id="logo">
            <a href="{{ URL::to('/') }}">
                <img src="{{ asset($site_image->logo) }}" width="" height="" alt="" class="logo_normal" style="width: 170px;">
                <img src="{{ asset($site_image->logo_black) }}" width="" height="" alt="" class="logo_sticky" style="width: 170px;">
            </a>
        </div>
        <ul id="top_menu">
            <li><a href="#0" class="search-overlay-menu-btn"></a></li>
            <li>
                <div class="dropdown dropdown-cart PopUpCartItem">
                    @include('frontend.layouts.popup_cart')
                </div>
                <!-- /dropdown-cart-->
            </li>
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="{{ URL::to('/') }}"><img src="{{ asset($site_image->logo) }}" width="" height="" alt="" style="width: 170px;"></a>
                <!--<p class="mobile_menu_site_name">{{$siteInfo->site_name}}</p>-->
            </div>
            <ul class="mt-3">
                
                <li>
                    <a href="{{ URL::to('/') }}" >Home</a>
                </li>
                
                <li class="submenu">
                    <!--<a href="{{route('menus')}}" class="show-submenu">Menu</a>-->
                     <a href="#" class="show-submenu">Menu</a>
                     <ul>
                        @foreach($categories as $category)
                            <li><a href="{{ route('items', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <!--<li>-->
                <!--    <a href="{{route('shop')}}">Shop</a>-->
                <!--</li>-->
                <li>
                    <a href="{{route('gallery')}}">Gallery</a>
                </li>
                <li>
                    <a href="{{route('facilities')}}">Facilities</a>
                </li>
                <!--<li>-->
                <!--    <a href="{{route('blog')}}">Blog</a>-->
                <!--</li>-->
                <li>
                    <a href="{{route('contact')}}">Contacts</a>
                </li>
                <!--<li><a href="{{route('reservation')}}" class="btn_top">Booking</a></li>-->

                @if($user_id)
                <li><a href="{{route('account')}}" class="btn_top">Account</a></li>
                <li><a href="{{route('logout')}}" class="btn_top">Logout</a></li>                
                @else
                <li><a href="{{route('login')}}" class="btn_top">Sign in</a></li>
                <li><a href="{{route('register')}}" class="btn_top">Sign up</a></li>
                @endif
                
            </ul>
        </nav>
    </div>
    <!-- Search -->
    @include('frontend.layouts.search_form')
    <!-- End Search -->
    </header>
    <!-- /header -->