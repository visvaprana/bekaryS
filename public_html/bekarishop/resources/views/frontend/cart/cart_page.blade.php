@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title> Cart - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')


<?php 
    $coupone_code = Session::get('coupone_code');
    $discount = Session::get('discount');
    $coupon_percentage = Session::get('coupon_percentage');
?>


    <main>

        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->cart_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Your orders</h1>
                            <!-- <p>Order food with home delivery or take away</p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame gray"></div>
        </div>
        <!-- /hero_single -->
        
        <div class="bg_gray">
            <div class="container margin_60_40">
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                                Product
                            </th>
                            <!--<th>-->
                            <!--    Size-->
                            <!--</th>-->
                            <th>
                                Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Subtotal
                            </th>
                            <th>
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($contents) > 0)

                    <form action="{{URL::to('update-cart')}}" method="get">
                        @csrf
                        
                    
                    @foreach($contents as $content)
                        @if($content->rowId)
                            <input type="hidden" name="rowid[]" value="{{$content->rowId}}">
                        @endif

                        <?php
                            $product = App\Models\Product::where('id', $content->id)->first();
                            $ratings = App\Models\Rating::where('product_id', $product->id)->get();
                            $rating_count = App\Models\Rating::where('product_id', $product->id)->count();

                            $TotalRating = App\Models\Rating::where('product_id', $product->id)->sum('rate');


                            $AverageRating = 0;
                            if ($TotalRating > 0) {
                                $AverageRating = $TotalRating/$rating_count;
                            }

                        ?>

                        <tr class="cartItem">
                            
                            
                            <td>
                                <div class="thumb_cart">
                                    <img src="{{ asset($content->options->image) }}" data-src="{{ asset($content->options->image) }}" class="lazy" alt="Image">
                                </div>
                                <span class="item_cart">{{$content->qty}}x {{ Str::limit($content->name, 40) }}</span>
                            </td>
                            
                            
                            
                            <!--<td>-->
                            <!--    <strong>-->
                            <!--        @if($content->options->size)-->
                            <!--          {{$content->options->size}}-->
                            <!--        @else-->
                            <!--          --->
                            <!--        @endif-->
                            <!--    </strong>-->
                            <!--</td>-->
                            
                            
                            <td>
                                <strong>৳{{$content->price}}</strong>
                            </td>
                            
                            <td>
                                <div class="numbers-row">
                                    <input type="text" value="{{$content->qty}}" id="quantity_1" class="qty2" name="quantity[]" min="1">
                                    <div class="inc button_inc increaseCart" data-id="{{$content->rowId}}">+</div>
                                    <div class="dec button_inc decreaseCart" data-id="{{$content->rowId}}">-</div>
                                </div>
                            </td>
                            <td>
                                <strong>৳{{$content->price * $content->qty}}</strong>
                            </td>
                            <td class="options">
                                <a href="#" class="DeleteItem" data-id="{{$content->rowId}}"><img src="{{ asset('assets/frontend/') }}/css/SVG/close.svg" alt="{{ $site_seo->meta_title }}"></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="cartItem">
                            
                            
                            <td class="text-center" colspan="6">
                                <h3>Cart is empty</h3>
                            </td>
                            
                            
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                    <div class="col-sm-4 text-right">
                        <button type="submit" class="btn_1 outline">Update Cart</button>
                    </div>
                    </form>
                    <div class="col-sm-8">
                        <div class="apply-coupon">
                            <div class="form-group form-inline">
                                <form action="{{route('submit-coupon')}}" method="post">
                                    @csrf
                                    <input type="text" name="coupon_code" value="{{$coupone_code ?? ''}}" placeholder="Promo code" class="form-control d-inline" style="width: 150px;">
                                    <button type="submit" class="btn_1 outline">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /cart_actions -->
            </div>
            <!-- /container -->
        </div>

        <div class="box_cart">
            <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
            <ul>
                <li>
                    <span>Subtotal</span> ৳{{$sub_total}}
                </li>
                <li>
                    <span>Coupon  ({{$coupon_percentage ?? 0}}%) </span> ৳{{$discount ?? 0}}
                </li>
                <li>
                    <span>Total</span> 
                    <?php 
                        if($discount){
                            $totalPrice = ($sub_total + $siteinfo->tax) - $discount;
                        }else{
                            $totalPrice = $sub_total + $siteinfo->tax;
                        }

                    ?>
                    
                    ৳{{ floatval($totalPrice); }}

                </li>
            </ul>
            <a href="{{route('checkout')}}" class="btn_1 full-width cart">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->
        
    </main>





@stop
