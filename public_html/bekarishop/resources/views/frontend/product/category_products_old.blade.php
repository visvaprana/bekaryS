@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title>{{ $category->name }} - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')



    <main class="main">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h1 class="mb-15">{{ $category->name }}</h1>
                            <div class="breadcrumb">
                                <a href="{{ URL::to('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> {{ $category->name }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We found <strong class="text-brand">{{ $total_products }}</strong> items for you!</p>
                        </div>

                    </div>

                    <div class="row product-grid">



                        @foreach ($products as $product)

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

                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap wow fadeIn animated mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('/', [$product->slug]) }}">
                                                <img class="default-img"
                                                    src="{{ asset($product->product_image_small) }}"
                                                    alt="{{ $product->name }}">
                                                <img class="hover-img"
                                                    src="{{ asset($product->product_image_small) }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            @if ($user_id)
                                                <a aria-label="Add To Wishlist" class="action-btn AddWishlist" href=""
                                                    data-id="{{ $product->id }}"><i class="fi-rs-heart"></i></a>
                                            @else
                                                <a aria-label="Add To Wishlist" class="action-btn"
                                                    href="{{ route('login') }}"><i class="fi-rs-heart"></i></a>
                                            @endif

                                            <a aria-label="Quick view" class="action-btn open-product-details-popup"
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                data-id="{{ $product->id }}"><i class="fi-rs-eye"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @foreach ($stock_status as $status)
                                                <span class="hot">{{ $status->stock_status }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <!-- <a href="">Snack</a> -->
                                        </div>
                                        <h2><a
                                                href="{{ route('/', [$product->slug]) }}">{{ Str::limit($product->name, 18) }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="d-inline-block">
                                                @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                    ★★★★★

                                                @elseif($AverageRating >= 3.5 && $AverageRating < 4.5) ★★★★
                                                    @elseif($AverageRating>= 2.5 && $AverageRating < 3.5) ★★★
                                                        @elseif($AverageRating>= 1.5 && $AverageRating < 2.5) ★★
                                                            @elseif($AverageRating>= 0.5 && $AverageRating < 1.5) ★
                                                                @else ★ @endif
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $AverageRating ?? 1 }})</span>
                                        </div>
                                        <div>
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $product->total_sell }}%" aria-valuemin="0"
                                                        aria-valuemax="{{ $product->qty }}"></div>
                                                </div>
                                                <span class="font-xs text-heading"> Sold:
                                                    {{ $product->total_sell }}/{{ $product->qty }}</span>
                                            </div>
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                <span>৳{{ $product->discount_price ?? $product->sell_price }}</span>


                                                @if ($product->discount_price)
                                                    <span class="old-price">৳{{ $product->sell_price ?? '' }}</span>
                                                @endif

                                            </div>
                                            <div class="add-cart AddCart" data-id="{{ $product->id }}">
                                                <a class="add" href="" id="AddToCartBtn"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>

                                                <div class="text-center" id="AddCartLoaderGif" style="display: none">
                                                    <img src="{{ asset('assets/frontend/') }}/assets/imgs/loader.gif"
                                                        alt="Thaiparkrestaurent" style="width: 29px;">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                    <!--product grid-->
                    <!--                     <div class="pagination-area mt-20 mb-20">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                        <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a></li>
                                    </ul>
                                </nav>
                            </div> -->

                </div>
                @include('frontend.layouts.sidebar')
            </div>
        </div>
    </main>






@stop
