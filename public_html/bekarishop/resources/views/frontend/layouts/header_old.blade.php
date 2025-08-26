<?php

    $categories = App\Models\Category::get();
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

<header class="ps-header ps-header--11 ps-header--14">
    <div class="ps-header__middle">
        <div class="container">
            <div class="ps-logo"><a href="{{ URL::to('/') }}"> <img src="{{ asset($site_image->logo) }}" alt="{{ $siteInfo->site_name }}"><img class="sticky-logo" src="{{ asset($site_image->logo) }}" alt="{{ $siteInfo->site_name }}"></a></div>
            <div class="ps-header__right">
                <ul class="ps-header__icons">
                    <li><a class="ps-header__item open-search" href="#"><i class="icon-magnifier"></i></a></li>


                    <li>
                        @if($user_id)
                        <a class="ps-header__item" href="{{route('account')}}">
                            <i class="icon-user"></i>
                        </a>
                        <a class="ps-header__item" href="{{route('logout')}}">
                            <i class="fa fa-sign-out" style="color: #585858;font-size: 27px;"></i>
                        </a>
                        @else
                        <a class="ps-header__item" href="#" id="login-modal">
                            <i class="icon-user"></i>
                        </a>
                        @endif
                        
                        <div class="ps-login--modal">


                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ol>
                                        @foreach ($errors->all() as $error)
                                            <li style="font-size: 12px">{{ $error }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            @endif

                            @if (session()->has('wrong_notif'))
                                <div class="alert alert-danger">
                                    <strong style="font-size: 12px">{{ session()->get('wrong_notif') }}</strong>
                                </div>
                            @endif


                            <form method="post" action="{{route('login')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="text" name="email" required="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" required="">
                                </div>
                                
                                <button class="ps-btn ps-btn--warning" type="submit">Log In</button>
                            </form>
                        </div>

                            
                    </li>
                    
                    @if ($user_id)
                        <?php
                            $total_wishlist_item = App\Models\Wishlist::where('user_id', $user_id)->count();
                        ?>

                        <li><a class="ps-header__item" href="{{ route('wishlist') }}"><i class="fa fa-heart-o"></i><span class="badge totalWishlistItem">{{ $total_wishlist_item }}</span></a></li>

                    @endif


                    <li>
                        <div class="PopUpCartItem">
                            @include('frontend.layouts.popup_cart')
                        </div>

                    </li>
                </ul>
                <div class="ps-header__menu">
                    <ul class="menu">
                        <li class="nav-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="nav-item"><a href="{{route('shop')}}">shop</a></li>
                        <li class="nav-item"><a href="{{route('contact')}}">Contact</a></li>

                        <li class="fa fa-bars has-mega-menu"><a href="#">Products<span class="sub-toggle"><i class="fa fa-chevron-down"></i></span></a>
                            <div class="mega-menu">
                                <div class="container">
                                    <div class="mega-menu__row">
                                        @foreach ($main_categories as $item)
                                            <?php
                                            $sub_categories = App\Models\Category::where('parent_id', $item->id)
                                                ->where('status', 1)
                                                ->get();
                                            ?>
                                        @if (count($sub_categories) > 0)
                                        <div class="mega-menu__column">
                                            <h4>{{ $item->name }}</h4>
                                            <ul class="sub-menu--mega">
                                                @foreach ($sub_categories as $item)
                                                <li><a href="{{ route('/', [$item->slug]) }}">{{ $item->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="ps-header ps-header--14 ps-header--mobile">
    <div class="ps-header__middle">
        <div class="container">
            <div class="ps-logo"><a href="{{ URL::to('/') }}"> <img src="{{ asset($site_image->logo) }}" alt></a></div>
            <div class="ps-header__right">
                <ul class="ps-header__icons">
                    <li><a class="ps-header__item open-search" href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</header>