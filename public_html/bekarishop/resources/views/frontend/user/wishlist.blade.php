@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    $site_info = App\Models\Siteinfo::first();
    ?>
    <title> Wishlist- {{ $site_seo->meta_title }}</title>
@endsection
@section('content')







        <div class="ps-wishlist mar-top-page">
            <div class="container">
                <ul class="ps-breadcrumb">
                    <li class="ps-breadcrumb__item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="ps-breadcrumb__item active" aria-current="page">Wishlist</li>
                </ul>
                <h3 class="ps-wishlist__title">My wishlist on {{$site_info->site_name ?? ''}}</h3>
                <div class="ps-wishlist__content">
                    <ul class="ps-wishlist__list ">


                        @php $i=1; @endphp
                        @foreach($lists as $list)

                        <?php 
                            $product = App\Models\Product::where('id', $list->product_id)->first();
                            $stock_status = App\Models\ProductStockStatus::where('product_id', $product->id)->get();

                            $ratings = App\Models\Rating::where('product_id', $product->id)->get();
                            $rating_count = App\Models\Rating::where('product_id', $product->id)->count();

                            $TotalRating = App\Models\Rating::where('product_id', $product->id)->sum('rate');


                            $AverageRating = 0;
                            if ($TotalRating > 0) {
                                $AverageRating = $TotalRating/$rating_count;
                            }

                        ?>

                        <li class="wishlistItem">
                            <div class="ps-product ps-product--wishlist">
                                <div class="ps-product__remove RemoveFromWishlist" data-id="{{$product->id}}"><a href="#"><i class="icon-cross"></i></a></div>
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{route('/', [$product->slug])}}">
                                        <figure><img src="{{ asset($product->image) }}" alt="{{$product->name}}" /><img src="{{ asset($product->image) }}" alt="alt" />
                                        </figure>
                                    </a></div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="{{route('/', [$product->slug])}}">{{$product->name}}</a></h5>
                                    <div class="ps-product__row">
                                        <div class="ps-product__label">Price:</div>
                                        <div class="ps-product__value"><span class="ps-product__price sale">৳{{ $product->discount_price ?? $product->sell_price }}</span>
                                        @if ($product->discount_price)
                                        <span class="ps-product__del">
                                            ৳{{ $product->sell_price ?? '' }}</span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="ps-product__row ps-product__stock">
                                        <div class="ps-product__label">Stock:</div>
                                        <div class="ps-product__value">
                                            @foreach ($stock_status as $status)
                                                <span class="ps-product__out-stock">{{ $status->stock_status }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="ps-product__cart AddCart" data-id="{{$product->id}}">
                                        <button class="ps-btn "  >Add to cart</button>
                                    </div>
                                    <div class="ps-product__row ps-product__quantity">
                                        <div class="ps-product__label">Quantity:</div>
                                        <div class="ps-product__value">1</div>
                                    </div>
                                    <div class="ps-product__row ps-product__subtotal">
                                        <div class="ps-product__label">Subtotal:</div>
                                        <div class="ps-product__value">$77.65</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>
                    <div class="ps-wishlist__table">
                        <table class="table ps-table ps-table--product">
                            <thead>
                                <tr>
                                    <th class="ps-product__remove"></th>
                                    <th class="ps-product__thumbnail"></th>
                                    <th class="ps-product__name">Product name</th>
                                    <th class="ps-product__meta">Unit price</th>
                                    <th class="ps-product__status">Stock status</th>
                                    <th class="ps-product__cart"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i=1; @endphp
                                @foreach($lists as $list)
                                    <?php 
                                        $product = App\Models\Product::where('id', $list->product_id)->first();
                                        $stock_status = App\Models\ProductStockStatus::where('product_id', $product->id)->get();

                                        $ratings = App\Models\Rating::where('product_id', $product->id)->get();
                                        $rating_count = App\Models\Rating::where('product_id', $product->id)->count();

                                        $TotalRating = App\Models\Rating::where('product_id', $product->id)->sum('rate');


                                        $AverageRating = 0;
                                        if ($TotalRating > 0) {
                                            $AverageRating = $TotalRating/$rating_count;
                                        }

                                    ?>

                                <tr class="wishlistItem">
                                    <td class="ps-product__remove RemoveFromWishlist" data-id="{{$product->id}}"> <a href="#"><i class="icon-cross"></i></a></td>
                                    <td class="ps-product__thumbnail"><a class="ps-product__image" href="{{route('/', [$product->slug])}}">
                                            <figure><img src="{{ asset($product->image) }}" alt="{{$product->name}}"></figure>
                                        </a></td>
                                    <td class="ps-product__name"> <a href="{{route('/', [$product->slug])}}">{{ Str::limit($product->name, 35) }}</a></td>
                                    <td class="ps-product__meta"> <span class="ps-product__price sale">৳{{ $product->discount_price ?? $product->sell_price }}</span>
                                        @if ($product->discount_price)
                                        <span class="ps-product__del">
                                            ৳{{ $product->sell_price ?? '' }}</span>
                                        @endif
                                    </td>
                                    <td class="ps-product__status"> 
                                        @foreach ($stock_status as $status)
                                            <span class="ps-product__out-stock">{{ $status->stock_status }}</span>
                                        @endforeach
                                    </td>
                                    <td class="ps-product__cart AddCart" data-id="{{$product->id}}">
                                        <button class="ps-btn">Add to cart</button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>













@stop