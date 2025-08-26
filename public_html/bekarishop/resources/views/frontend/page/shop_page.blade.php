@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title>Shop - {{ $site_seo->meta_title }}</title>
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
    
    span.cursor-default.leading-5 {
        cursor: pointer;
    }

</style>

    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->shop_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Our Shop</h1>
                            <!-- <p>Order food with home delivery or take away</p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->


        
        <!-- /filters -->

        <div class="container margin_60_40">

            <div class="row small-gutters">

                @foreach($products as $product)
                <div class="col-6 col-md-4 col-xl-3" data-cue="slideInUp">
                    <div class="grid_item">
                        <figure>
                            @if ($product->discount)
                            <span class="ribbon off">-{{$product->discount}}%</span>
                            @endif
                            <a href="{{ route('/', [$product->slug]) }}">
                                <img class="img-fluid lazy" src="{{ asset($product->product_image_small) }}" data-src="{{ asset($product->product_image_small) }}" alt="">
                                <div class="add_cart AddCart" data-id="{{ $product->id }}"><span class="btn_1">Add to cart</span></div>
                            </a>
                        </figure>
                        
                        <a href="{{ route('/', [$product->slug]) }}">
                            <h3>{{ Str::limit($product->name, 23) }}</h3>
                        </a>
                        <div class="price_box">
                            <span class="new_price">
                                ৳{{ $product->discount_price ?? $product->sell_price }}
                            </span>
                            @if ($product->discount_price)
                                <span class="old_price">৳{{ $product->sell_price ?? '' }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /grid_item -->
                </div>
                @endforeach
                
            </div>
            <!-- /row -->
                
            <!-- <div class="pagination_fg add_bottom_15" data-cue="slideInUp">
                <a href="#">&laquo;</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">&raquo;</a>
            </div>   -->    
            
            <div class="text-center">
                {{$products->render()}}
            </div>

        </div>
        <!-- /container -->

    </main>


@stop
