<?php
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
?>





<div class="ps-navigation--footer">
    <div class="ps-nav__item"><a href="#" id="open-menu"><i class="icon-menu"></i></a><a href="#"
            id="close-menu"><i class="icon-cross"></i></a></div>
    <div class="ps-nav__item"><a href="{{ URL::to('/') }}"><i class="icon-home2"></i></a></div>
    @if ($user_id)
        <?php
        $total_wishlist_item = App\Models\Wishlist::where('user_id', $user_id)->count();
        ?>
        <div class="ps-nav__item"><a href="{{ route('account') }}"><i class="icon-user"></i></a></div>
        <div class="ps-nav__item"><a href="{{ route('wishlist') }}"><i class="fa fa-heart-o"></i><span
                    class="badge totalWishlistItem">{{ $total_wishlist_item ?? 0 }}</span></a></div>
    @endif
    <div class="ps-nav__item"><a href="{{ route('cart-page') }}"><i class="icon-cart-empty"></i><span
                class="badge">{{ $total_item ?? 0 }}</span></a></div>
</div>
<div class="ps-menu--slidebar">
    <div class="ps-menu__content">
        <ul class="menu--mobile">
            <li class="menu-item-has-children"><a href="{{ URL::to('/') }}">Home</a></li>

            @foreach ($main_categories as $item)
                <?php
                $sub_categories = App\Models\Category::where('parent_id', $item->id)
                    ->where('status', 1)
                    ->get();
                ?>

                <li class="menu-item-has-children"><a
                        href="{{ route('/', [$item->slug]) }}">{{ $item->name }}</a><span class="sub-toggle"><i
                            class="fa fa-chevron-down"></i></span>

                    @if (count($sub_categories) > 0)
                        <ul class="sub-menu">
                            @foreach ($sub_categories as $sub_category)
                                <li><a href="{{ route('/', [$sub_category->slug]) }}">{{ $sub_category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach


            <li class="menu-item-has-children"><a href="{{ route('shop') }}">Shop</a></li>
            <li class="menu-item-has-children"><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </div>
    <div class="ps-menu__footer">
        <div class="ps-menu__item">
            <div class="ps-menu__contact">Need help? <strong>{{ $siteInfo->phone }} -
                    {{ $siteInfo->site_name }}</strong></div>
        </div>
    </div>
</div>
<button class="btn scroll-top"><i class="fa fa-angle-double-up"></i></button>
<div class="ps-preloader" id="preloader">
    <div class="ps-preloader-section ps-preloader-left"></div>
    <div class="ps-preloader-section ps-preloader-right"></div>
</div>
