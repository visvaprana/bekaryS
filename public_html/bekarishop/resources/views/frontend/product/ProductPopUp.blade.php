<?php

$ratings = App\Models\Rating::where('product_id', $product->id)->get();
$rating_count = App\Models\Rating::where('product_id', $product->id)->count();
$TotalRating = App\Models\Rating::where('product_id', $product->id)->sum('rate');

$AverageRating = 0;
if ($TotalRating > 0) {
    $AverageRating = $TotalRating / $rating_count;
}

?>

<div class="row">
    <div class="col-12 col-xl-6">
        <div class="ps-product--gallery">
            <div class="ps-product__thumbnail">
                @foreach ($productImages as $image)
                <div class="slide"><img src="{{ asset($image->product_image) }}" alt="{{ $product->name ?? '' }}" /></div>
                @endforeach
            </div>
            <div class="ps-gallery--image">
                @foreach ($productImages as $image)
                <div class="slide">
                    <div class="ps-gallery__item"><img src="{{ asset($image->product_image_thumb) }}" alt="{{ $product->name ?? '' }}" /></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6">
        <div class="ps-product__info">
            <div class="ps-product__badge">
                <span class="ps-badge ps-badge--instock"> 
                    @foreach ($stock_status as $status)
                        {{ $status->stock_status }}
                    @endforeach
                </span>
            </div>
            <div class="ps-product__branch">
                @foreach ($ProductCategories as $ProductCategory)
                <a href="{{ route('/', [$ProductCategory->category->slug ?? '']) }}">{{ $ProductCategory->category->name ?? '' }}</a>
                @endforeach
            </div>
            <div class="ps-product__title"><a href="#">{{ $product->name ?? '' }}</a></div>
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
            <div class="ps-product__desc">
                <ul class="ps-product__list">
                    @if(count($ProductSpecifications)>0)
                        @foreach($ProductSpecifications as $val)
                            <li>{{$val->specification}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="ps-product__meta"><span class="ps-product__price">৳{{ $product->discount_price ?? $product->sell_price }}</span>
            </div>

            <form id="OrderDetails">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="ps-product__quantity">
                    <h6>Quantity</h6>
                    <div class="d-md-flex align-items-center">
                        <div class="def-number-input number-input safari_only">
                            <button type="button" class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                            <input class="quantity" min="0" name="quantity" value="1" type="number" />
                            <button  type="button" class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                        </div>
                        <a class="ps-btn ps-btn--warning AddCart" data-id="{{ $product->id }}" href="#" data-toggle="modal" data-target="#popupAddcartV2">Add to cart</a>
                    </div>
                </div>
            </form>


            <div class="ps-product__type">
                <ul class="ps-product__list">
                    <li> <span class="ps-list__title">Brands: </span>
                        @foreach ($productBrands as $productBrand)
                        <a class="ps-list__text" href="#">{{ $productBrand->brand->name ?? '' }}</a>
                        @endforeach
                    </li>
                    @if($product->sku)
                    <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text" href="#">{{ $product->sku ?? '' }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

@include('frontend.layouts.popup_js')


<script>
    

(function($) {
    "use strict";


    function slickCarousel() {
        if ($('.ps-product--gallery .ps-product__thumbnail').length) {
            $('.ps-product--gallery .ps-product__thumbnail')
            .on('init', function (slick) {
                $('.ps-product--gallery .ps-product__thumbnail').fadeIn(1000);
            })
            .slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                lazyLoad: 'ondemand',
                asNavFor: '.ps-gallery--image'
            });

            $('.ps-gallery--image')
            .on('init', function (slick) {
                $('.ps-gallery--image').fadeIn(1000);
            })
            .slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                lazyLoad: 'ondemand',
                asNavFor: '.ps-product--gallery .ps-product__thumbnail',
                dots: false,
                arrows: false,
                focusOnSelect: true
            });

            //remove active class from all thumbnail slides
            $('.ps-gallery--image .slick-slide').removeClass('slick-active');

            //set active class to first thumbnail slides
            $('.ps-gallery--image .slick-slide').eq(0).addClass('slick-active');

            // On before slide change match active thumbnail to current slide
            $('.ps-product--gallery .ps-product__thumbnail').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
                var mySlideNumber = nextSlide;
                $('.ps-gallery--image .slick-slide').removeClass('slick-active');
                $('.ps-gallery--image .slick-slide').eq(mySlideNumber).addClass('slick-active');
            });
        }

        $('.modal').on('shown.bs.modal', function (e) {
            $('.ps-product--gallery .ps-product__thumbnail').slick('setPosition');
            $('.ps-gallery--image').slick('setPosition');
            $('.wrap-modal-slider').addClass('open');
        })
    }


    $(function() {

        slickCarousel();

    });

    $(window).on('load', function() {
       
    });
})(jQuery);


</script>