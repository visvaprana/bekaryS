<?php
$user_id = Session::get('user_id');
$total_item = Cart::content()->count();
        $contents = Cart::content();
                $sub_total = Cart::subtotal()
?>

<div class="header-action-2">


    <div class="header-action-icon-2">
        <a class="mini-cart-icon" href="{{ route('cart-page') }}">
            <img alt="Nest" src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-cart.svg">
            <span class="pro-count blue totalItem">{{ $total_item }}</span>
        </a>
        <span class="lable">Cart</span>
        @include('frontend.layouts.popup_cart')


    </div>
    @if ($user_id)

        <?php
        $total_wishlist_item = App\Models\Wishlist::where('user_id', $user_id)->count();
        ?>



        <div class="header-action-icon-2">
            <a href="{{ route('wishlist') }}">
                <img class="svgInject" alt="Nest"
                    src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-heart.svg">
                <span class="pro-count blue totalWishlistItem">{{ $total_wishlist_item ?? 0 }}</span>
            </a>
            <span class="lable">Wishlist</span>
        </div>


        <div class="header-action-icon-2">


            <a href="{{ route('account') }}">
                <img class="svgInject" alt="Nest"
                    src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-user.svg" />
            </a>
            <a href="{{ route('account') }}" class="w-auto"><span class="lable ml-0">Account</span></a>

            <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                <ul>
                    <li>
                        <a href="{{ route('account') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}#track-orders"><i class="fi fi-rs-location-alt mr-10"></i>Order
                            Tracking</a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                    </li>
                    <li>
                        <a href="{{ route('account') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                    </li>
                </ul>
            </div>

        </div>

    @else

        <a href="{{ route('login') }}">
            <div class="header-action-icon-2">
                <span class="lable ml-0">Login</span>
            </div>
        </a>

        <a href="{{ route('register') }}">
            <div class="header-action-icon-2">
                <span class="lable ml-0">Register</span>
            </div>
        </a>

    @endif




</div>
