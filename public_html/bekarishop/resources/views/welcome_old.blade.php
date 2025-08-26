@extends('frontend.layouts.app')


@section('head')
    <title>{{ $site_seo->meta_title }}</title>
    <meta name="title" content="{{ $site_seo->meta_title }}">
    <meta name="description" content="{{ $site_seo->meta_des }}">
    <meta name="keywords" content="{{ $site_seo->meta_keywords }}" />
    <meta property="type" content="Website" />
    <link rel="canonical" href="{{ $site_seo->canonical }}" />
    <meta name="robots" content="{{ $site_seo->robots }}" />
    <meta property="site_name" content="Thaiparkrestaurent" />
    <meta property="image" content="{{ $doamin }}{{ $site_seo->meta_image }}" />



    <meta property="og:url" content="{{ $doamin }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $site_seo->meta_title }}" />
    <meta property="og:description" content="{{ $site_seo->meta_des }}" />
    <meta property="og:keywords" content="{{ $site_seo->meta_keywords }}" />
    <meta property="og:image" content="{{ $doamin }}{{ $site_seo->meta_image }}" />


    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@Thaiparkrestaurent" />
    <meta name="twitter:creator" content="@Thaiparkrestaurent" />
    <meta property="twitter:url" content="{{ $doamin }}" />
    <meta property="twitter:title" content="{{ $site_seo->meta_title }}" />
    <meta property="twitter:description" content="{{ $site_seo->meta_des }}" />
    <meta property="twitter:keywords" content="{{ $site_seo->meta_keywords }}" />
    <meta property="twitter:image" content="{{ $doamin }}{{ $site_seo->meta_image }}" />


@endsection

@section('content')

    <div class="ps-home ps-home--15">
        <section class="ps-section--banner">
            <div class="ps-section__overlay">
                <div class="ps-section__loading"></div>
            </div>
            <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="15000" data-owl-gap="0"
                data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1"
                data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">


                @foreach ($banners as $banner)
                    <div class="ps-banner" style="background:#DAECFA; "><img class="d-block ps-banner__imagebg"
                            src="{{ asset($banner->image) }}" alt="{{ $banner->title ?? '' }}" />
                        <div class="container container-initial">
                            <div class="ps-banner__block">
                                <div class="ps-banner__content">
                                    <h2 class="ps-banner__title">{{ $banner->title ?? '' }}</h2>
                                    <div class="ps-banner__desc">{{ $banner->subscribe_title ?? '' }}</div>
                                    <div class="ps-banner__price">
                                    </div><a class="bg-white text-dark ps-banner__shop"
                                        href="{{ $banner->url ?? '' }}">{{ $banner->btn_txt ?? '' }}</a>
                                </div>
                                <div class="ps-banner__thumnail ps-banner__fluid"><img class="ps-banner__image"
                                        src="{{ asset($banner->image) }}" alt="{{ $banner->title ?? '' }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>
        <div class="ps-home__content">

            <div class="col-md-12">

                <section class="ps-section--categories">
                    <h3 class="ps-section__title">Popular categories</h3>
                    <div class="ps-section__content">
                        <div class="ps-categories__list">

                            @foreach ($allcategories as $category)
                                <div class="ps-categories__item"><a class="ps-categories__link"
                                        href="{{ route('/', [$category->slug]) }}"><img
                                            src="{{ asset($category->image ?? '') }}" alt></a><a
                                        class="ps-categories__name"
                                        href="{{ route('/', [$category->slug]) }}">{{ Str::limit($category->name, 11) }}</a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>

            </div>

            <section class="ps-section--latest">
                <div class="container">
                    <h3 class="ps-section__title">Latest products</h3>
                    <div class="ps-section__carousel">
                        <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="13000"
                            data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2"
                            data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-item-xl="5"
                            data-owl-duration="1000" data-owl-mousedrag="on">


                            @foreach ($latest_product as $product)

                                <?php
                                $stock_status = App\Models\ProductStockStatus::where('product_id', $product->id)->get();
                                
                                $ratings = App\Models\Rating::where('product_id', $product->id)->get();
                                $rating_count = App\Models\Rating::where('product_id', $product->id)->count();
                                
                                $TotalRating = App\Models\Rating::where('product_id', $product->id)->sum('rate');
                                
                                $AverageRating = 0;
                                if ($TotalRating > 0) {
                                    $AverageRating = $TotalRating / $rating_count;
                                }
                                
                                ?>

                                <div class="ps-section__product">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail">
                                            <a class="ps-product__image" href="{{ route('/', [$product->slug]) }}">
                                                <figure>
                                                    <img src="{{ asset($product->product_image_small) }}"
                                                        alt="{{ $product->name }}" />

                                                    <img src="{{ asset($product->product_image_small) }}"
                                                        alt="{{ $product->name }}" />
                                                </figure>
                                            </a>
                                            <div class="ps-product__actions">

                                                @if ($user_id)
                                                    <div class="ps-product__item AddWishlist"
                                                        data-id="{{ $product->id }}" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist"><a href="#"><i
                                                                class="fa fa-heart-o"></i></a></div>
                                                @else
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist"><a
                                                            href="{{ route('login') }}"><i class="fa fa-heart-o"></i></a>
                                                    </div>
                                                @endif


                                                <div class="ps-product__item open-product-details-popup"
                                                    data-id="{{ $product->id }}" data-toggle="tooltip"
                                                    data-placement="left" title="Quick view"><a href="#" data-toggle="modal"
                                                        data-target="#popupQuickview"><i class="fa fa-search"></i></a>
                                                </div>


                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left"
                                                    title="Add to cart">

                                                    <a href="#" data-toggle="modal" data-target="#popupAddcart"
                                                        class="AddCart" data-id="{{ $product->id }}"><i
                                                            class="fa fa-shopping-basket"></i></a>

                                                </div>



                                            </div>
                                            <div class="ps-product__badge">
                                                <div class="ps-badge ps-badge--sale">
                                                    @foreach ($stock_status as $status)
                                                        {{ $status->stock_status }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-product__content">
                                            <h5 class="ps-product__title"><a
                                                    href="{{ route('/', [$product->slug]) }}">{{ Str::limit($product->name, 23) }}</a>
                                            </h5>
                                            <div class="ps-product__meta"><span
                                                    class="ps-product__price sale">৳{{ $product->discount_price ?? $product->sell_price }}</span>

                                                @if ($product->discount_price)
                                                    <span
                                                        class="ps-product__del">৳{{ $product->sell_price ?? '' }}</span>
                                                @endif

                                            </div>
                                            <div class="ps-product__rating">
                                                @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                    <span class="rating_color">★★★★★</span>

                                                @elseif($AverageRating >= 3.5 && $AverageRating < 4.5) <span
                                                        class="rating_color"> ★★★★ </span>
                                                    @elseif($AverageRating>= 2.5 && $AverageRating < 3.5) <span
                                                            class="rating_color"> ★★★ </span>
                                                        @elseif($AverageRating>= 1.5 && $AverageRating < 2.5) <span
                                                                class="rating_color"> ★★ </span>
                                                            @elseif($AverageRating>= 0.5 && $AverageRating < 1.5) <span
                                                                    class="rating_color">★</span>
                                                                @else <span class="rating_color">★</span>
                                                @endif


                                            </div>

                                            <div class="ps-product__desc">
                                                <ul class="ps-product__list">
                                                    <li>Study history up to 30 days</li>
                                                    <li>Up to 5 users simultaneously</li>
                                                    <li>Has HEALTH certificate</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__actions ps-product__group-mobile">
                                                <div class="ps-product__quantity">
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                class="icon-minus"></i></button>
                                                        <input class="quantity" min="0" name="quantity" value="1"
                                                            type="number" />
                                                        <button class="plus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                class="icon-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="ps-product__cart">
                                                    <a class="ps-btn ps-btn--warning AddCart"
                                                        data-id="{{ $product->id }}" href="#" data-toggle="modal"
                                                        data-target="#popupAddcart">Add to cart</a>
                                                </div>
                                                <div class="ps-product__item cart" data-toggle="tooltip"
                                                    data-placement="left" title="Add to cart"><a href="#"><i
                                                            class="fa fa-shopping-basket"></i></a></div>


                                                @if ($user_id)
                                                    <div class="ps-product__item AddWishlist"
                                                        data-id="{{ $product->id }}" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist"><a href="#"><i
                                                                class="fa fa-heart-o"></i></a></div>
                                                @else
                                                    <div class="ps-product__item" data-toggle="tooltip"
                                                        data-placement="left" title="Wishlist"><a
                                                            href="{{ route('login') }}"><i class="fa fa-heart-o"></i></a>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </section>



            <!-- futhure product section -->
            <div class="container">
                <section class="ps-section--featured">
                    <h3 class="ps-section__title">Featured products</h3>
                    <div class="ps-section__content">
                        <div class="row m-0">


                            @foreach ($latest_product as $product)

                                <?php
                                $stock_status = App\Models\ProductStockStatus::where('product_id', $product->id)->get();
                                
                                $ratings = App\Models\Rating::where('product_id', $product->id)->get();
                                $rating_count = App\Models\Rating::where('product_id', $product->id)->count();
                                
                                $TotalRating = App\Models\Rating::where('product_id', $product->id)->sum('rate');
                                
                                $AverageRating = 0;
                                if ($TotalRating > 0) {
                                    $AverageRating = $TotalRating / $rating_count;
                                }
                                
                                ?>
                                <div class="col-6 col-md-4 col-lg-2dot4 p-0">
                                    <div class="ps-section__product">
                                        <div class="ps-product ps-product--standard">
                                            <div class="ps-product__thumbnail">
                                                <a class="ps-product__image" href="{{ route('/', [$product->slug]) }}">
                                                    <figure>
                                                        <img src="{{ asset($product->product_image_small) }}"
                                                            alt="{{ $product->name }}" />

                                                        <img src="{{ asset($product->product_image_small) }}"
                                                            alt="{{ $product->name }}" />
                                                    </figure>
                                                </a>
                                                <div class="ps-product__actions">

                                                    @if ($user_id)
                                                        <div class="ps-product__item AddWishlist"
                                                            data-id="{{ $product->id }}" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a href="#"><i
                                                                    class="fa fa-heart-o"></i></a></div>
                                                    @else
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                href="{{ route('login') }}"><i
                                                                    class="fa fa-heart-o"></i></a></div>
                                                    @endif

                                                    <div class="ps-product__item open-product-details-popup"
                                                        data-id="{{ $product->id }}" data-toggle="tooltip"
                                                        data-placement="left" title="Quick view"><a href="#"
                                                            data-toggle="modal" data-target="#popupQuickview"><i
                                                                class="fa fa-search"></i></a></div>


                                                    <div class="ps-product__item " data-toggle="tooltip"
                                                        data-placement="left" title="Add to cart">

                                                        <a href="#" data-toggle="modal" data-target="#popupAddcart"
                                                            class="AddCart" data-id="{{ $product->id }}"><i
                                                                class="fa fa-shopping-basket"></i></a>
                                                    </div>


                                                </div>
                                                <div class="ps-product__badge">
                                                    <div class="ps-badge ps-badge--sale">
                                                        @foreach ($stock_status as $status)
                                                            {{ $status->stock_status }}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ps-product__content">
                                                <h5 class="ps-product__title"><a
                                                        href="{{ route('/', [$product->slug]) }}">{{ Str::limit($product->name, 23) }}</a>
                                                </h5>
                                                <div class="ps-product__meta"><span
                                                        class="ps-product__price sale">৳{{ $product->discount_price ?? $product->sell_price }}</span>

                                                    @if ($product->discount_price)
                                                        <span
                                                            class="ps-product__del">৳{{ $product->sell_price ?? '' }}</span>
                                                    @endif

                                                </div>
                                                <div class="ps-product__rating">
                                                    @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                        <span class="rating_color">★★★★★</span>

                                                    @elseif($AverageRating >= 3.5 && $AverageRating < 4.5) <span
                                                            class="rating_color"> ★★★★ </span>
                                                        @elseif($AverageRating>= 2.5 && $AverageRating < 3.5) <span
                                                                class="rating_color"> ★★★ </span>
                                                            @elseif($AverageRating>= 1.5 && $AverageRating < 2.5) <span
                                                                    class="rating_color"> ★★ </span>
                                                                @elseif($AverageRating>= 0.5 && $AverageRating < 1.5)
                                                                        <span class="rating_color">★</span>
                                                                    @else <span class="rating_color">★</span>
                                                    @endif


                                                </div>

                                                <div class="ps-product__desc">
                                                    <ul class="ps-product__list">
                                                        <li>Study history up to 30 days</li>
                                                        <li>Up to 5 users simultaneously</li>
                                                        <li>Has HEALTH certificate</li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__actions ps-product__group-mobile">
                                                    <div class="ps-product__quantity">
                                                        <div class="def-number-input number-input safari_only">
                                                            <button class="minus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                    class="icon-minus"></i></button>
                                                            <input class="quantity" min="0" name="quantity" value="1"
                                                                type="number" />
                                                            <button class="plus"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                    class="icon-plus"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="ps-product__cart">
                                                        <a class="ps-btn ps-btn--warning AddCart"
                                                            data-id="{{ $product->id }}" href="#" data-toggle="modal"
                                                            data-target="#popupAddcart">Add to cart</a>
                                                    </div>

                                                    <div class="ps-product__item cart" data-toggle="tooltip"
                                                        data-placement="left" title="Add to cart"><a href="#"><i
                                                                class="fa fa-shopping-basket"></i></a></div>

                                                    @if ($user_id)
                                                        <div class="ps-product__item AddWishlist"
                                                            data-id="{{ $product->id }}" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a href="#"><i
                                                                    class="fa fa-heart-o"></i></a></div>
                                                    @else
                                                        <div class="ps-product__item" data-toggle="tooltip"
                                                            data-placement="left" title="Wishlist"><a
                                                                href="{{ route('login') }}"><i
                                                                    class="fa fa-heart-o"></i></a></div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="ps-shop__more"><a href="#">Show all</a></div>
                    </div>
                </section>
            </div>
            <!-- end futhure section -->


            <section class="ps-section--newsletter ps-section--newsletter-info"
                data-background="{{ asset($site_info->subscribe_image) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="ps-section__body">
                                <h3 class="ps-section__title">{{ $site_info->subscribe_title ?? '' }}</h3>
                                <div class="ps-section__content">
                                    <form action="{{ route('subscription') }}" method="post">
                                        @csrf
                                        <div class="ps-form--subscribe">
                                            <div class="ps-form__control">
                                                <input class="form-control ps-input" name="email" type="email"
                                                    placeholder="Enter your email address" required="" />
                                                <button type="submit" class="ps-btn ps-btn--warning">Subscribe</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


@stop
