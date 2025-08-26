@extends('frontend.layouts.app')


@section('head')
    <title>{{ $product->name }} - {{ $site_seo->meta_title }}</title>
    <meta name="title" content="{{ $product->meta_title }}">
    <meta name="description" content="{{ $product->meta_des }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}" />
    <meta property="type" content="Product" />
    <link rel="canonical" href="{{$domain}}{{ $product->slug }}" />
    <meta property="site_name" content="{{ $siteinfo->site_name }}" />
    <meta property="image" content="{{$domain}}{{ $product->image }}" />

    <meta property="og:url" content="{{$domain}}{{ $product->slug }}" />
    <meta property="og:type" content="Product" />
    <meta property="og:title" content="{{ $product->meta_title }}" />
    <meta property="og:description" content="{{ $product->meta_des }}" />
    <meta property="og:keywords" content="{{ $product->meta_keywords }}" />
    <meta property="og:image" content="{{$domain}}{{ $product->image }}" />


    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@ {{$site_info->site_name}}" />
    <meta name="twitter:creator" content="@ {{$site_info->site_name}}" />
    <meta property="twitter:url" content="{{$domain}}{{ $product->slug }}" />
    <meta property="twitter:title" content="{{ $product->meta_title }}" />
    <meta property="twitter:description" content="{{ $product->meta_des }}" />
    <meta property="twitter:keywords" content="{{ $product->meta_keywords }}" />
    <meta property="twitter:image" content="{{$domain}}{{ $product->image }}" />


@endsection


@section('content')


    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset('assets/frontend/') }}/img/hero_menu.jpg)">
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

        <div class="container margin_60_40">
            <div class="row">
                <div class="col-lg-6 magnific-gallery">

                    @foreach ($productImages as $productImage)
                    <p>
                        <a href="{{ $productImage->product_image ?? '' }}" title="Photo title" data-effect="mfp-zoom-in"><img src="{{ $productImage->product_image ?? '' }}" alt="" class="img-fluid"></a>
                    </p>
                    @endforeach

                </div>
                <div class="col-lg-6" id="sidebar_fixed">
                    <form  id="OrderDetails">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="prod_info">
                            
                            <h1>{{ $product->name ?? '' }}</h1>

                            @if(count($ProductHighLights)>0)

                                @foreach($ProductHighLights as $val)
                                    <p>{{$val->highlights}}</p>
                                @endforeach

                            @endif

                            <div class="prod_options">
                                @if (count($productSizes) > 0)
                                <div class="row">
                                    <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Size</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                        <div class="">
                                            <select name="size" class="wide form-control" required="">
                                                @foreach ($productSizes as $productSize)
                                                <option value="{{ $productSize->size->name ?? '' }}" selected>{{ $productSize->size->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="quantity_1" class="qty2" name="quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="price_main">
                                        <span class="new_price">

                                            ৳{{ $product->discount_price ?? $product->sell_price }}</span>
                                        
                                        @if ($product->discount)
                                            <span class="percentage">-{{ $product->discount ?? '' }}%</span> 
                                            <span class="old_price"> ৳{{ $product->sell_price ?? '' }}</span>

                                           
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="btn_add_to_cart AddCart" data-id="{{ $product->id }}"><a href="" class="btn_1">Add to Cart</a></div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /prod_info -->
                </div>
            </div>
            <!-- /row -->           
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                    Description
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! $product->description !!}
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Specifications (100g)</h3>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <tbody>
                                                    @if(count($ProductSpecifications)>0)
                                                        @foreach($ProductSpecifications as $val)
                                                        <tr>
                                                            <td>
                                                                <strong>
                                                                    {{$val->specification}}

                                                                </strong>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- /tab-content -->
            </div>
        </div>
    </main>



@stop
