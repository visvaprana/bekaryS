@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title>{{ $category->name }} - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')

<style>
    .w-5{
        width: 40px;
    }
    .hidden{
        display: block;
    }

    .flex.justify-between.flex-1.sm\:hidden{
        display: none;
    }

    p.text-sm.text-gray-700.leading-5 {
        display: none;
    }
    
   

</style>

<div class="ps-categogy mar-top-page">
    <div class="container">
        <ul class="ps-breadcrumb">
            <li class="ps-breadcrumb__item"><a href="{{URL::to('/')}}">Home</a></li>
            <li class="ps-breadcrumb__item"><a href="{{route('shop')}}">Shop</a></li>
            <li class="ps-breadcrumb__item active" aria-current="page">{{ $category->name }}</li>
        </ul>
        <!-- <h1 class="ps-categogy__name">Diagnosis<sup>(32)</sup></h1> -->
        <div class="ps-categogy__content">
            <div class="row row-reverse">
                <div class="col-12 col-md-9">
                    
                    <div class="ps-categogy--grid ps-categogy--detail">
                        <div class="row m-0">


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
                                <div class="col-6 col-lg-4 p-0">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{ route('/', [$product->slug]) }}">
                                                <figure><img src="{{ asset($product->product_image_small) }}" alt="{{ $product->name }}" />
                                                </figure>
                                            </a>
                                            <div class="ps-product__actions">
                                                 @if ($user_id)
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                                @else
                                                <div class="ps-product__item" title="Wishlist"><a href="{{route('wishlist')}}"><i class="fa fa-heart-o"></i></a></div>
                                                @endif


                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                            </div>
                                            <div class="ps-product__badge">
                                            </div>
                                        </div>
                                        <div class="ps-product__content">
                                            <div class="ps-badge ps-badge--sale">
                                                @foreach ($stock_status as $status)
                                                    {{ $status->stock_status }}
                                                @endforeach
                                            </div>
                                            <h5 class="ps-product__title"><a href="{{ route('/', [$product->slug]) }}">{{ Str::limit($product->name, 50) }}</a></h5>
                                            <div class="ps-product__meta"><span class="ps-product__price sale">৳{{ $product->discount_price ?? $product->sell_price }}</span>
                                                @if ($product->discount_price)
                                                    <span class="ps-product__del">৳{{ $product->sell_price ?? '' }}</span>
                                                @endif
                                            </div>
                                            <div class="ps-product__rating">
                                                @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                    <span class="rating_color">★★★★★</span>

                                                @elseif($AverageRating >= 3.5 && $AverageRating < 4.5)
                                                <span class="rating_color"> ★★★★ </span>
                                                    @elseif($AverageRating>= 2.5 && $AverageRating < 3.5) 
                                                    <span class="rating_color"> ★★★ </span>
                                                        @elseif($AverageRating>= 1.5 && $AverageRating < 2.5)
                                                        <span class="rating_color"> ★★ </span>
                                                            @elseif($AverageRating>= 0.5 && $AverageRating < 1.5) <span class="rating_color">★</span>
                                                                @else <span class="rating_color">★</span> @endif
                                                <span class="ps-product__review">({{ $AverageRating ?? 1 }} Reviews)</span>
                                            </div>
                                            
                                            <div class="ps-product__actions ps-product__group-mobile">
                                                <div class="ps-product__quantity">
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                        <input class="quantity" min="0" name="quantity" value="1" type="number" />
                                                        <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                                    </div>
                                                </div>

                                                <div class="ps-product__cart AddCart" data-id="{{ $product->id }}"> <a class="ps-btn ps-btn--warning add"  href="#" data-toggle="modal" data-target="#popupAddcart"  id="AddToCartBtn">Add to cart</a></div>

                                                <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>

                                                @if ($user_id)
                                                <div class="ps-product__item AddWishlist"  data-id="{{ $product->id }}" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                                @else
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="{{route('wishlist')}}"><i class="fa fa-heart-o"></i></a></div>

                                                @endif
                                                


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                    <div class="ps-categogy__loading">
                        <!-- <button class="ps-btn ps-btn--primary">Load more</button> -->

                        {!! $products->render() !!}

                    </div>
                    <!-- <div class="ps-pagination">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                    </div> -->

                </div>


                @include('frontend.layouts.sidebar')



                
            </div>
        </div>
    </div>
</div>




@stop
