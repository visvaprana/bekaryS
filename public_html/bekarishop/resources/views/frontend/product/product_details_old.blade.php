@extends('frontend.layouts.app')


@section('head')
    <title>{{ $product->name }} - Thaiparkrestaurent</title>
    <meta name="title" content="{{ $product->meta_title }}">
    <meta name="description" content="{{ $product->meta_des }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}" />
    <meta property="type" content="Product" />
    <link rel="canonical" href="https://thaiparkrestaurent.com/{{ $product->slug }}" />
    <meta property="site_name" content="{{ $siteinfo->site_name }}" />
    <meta property="image" content="https://thaiparkrestaurent.com/{{ $product->image }}" />



    <meta property="og:url" content="https://thaiparkrestaurent.com/{{ $product->slug }}" />
    <meta property="og:type" content="Product" />
    <meta property="og:title" content="{{ $product->meta_title }}" />
    <meta property="og:description" content="{{ $product->meta_des }}" />
    <meta property="og:keywords" content="{{ $product->meta_keywords }}" />
    <meta property="og:image" content="https://thaiparkrestaurent.com/{{ $product->image }}" />


    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@Thaiparkrestaurent" />
    <meta name="twitter:creator" content="@Thaiparkrestaurent" />
    <meta property="twitter:url" content="https://thaiparkrestaurent.com/{{ $product->slug }}" />
    <meta property="twitter:title" content="{{ $product->meta_title }}" />
    <meta property="twitter:description" content="{{ $product->meta_des }}" />
    <meta property="twitter:keywords" content="{{ $product->meta_keywords }}" />
    <meta property="twitter:image" content="https://thaiparkrestaurent.com/{{ $product->image }}" />


@endsection


@section('content')




    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <!-- <span></span> <a href="shop-grid-right.html">Vegetables & tubers</a> -->
                    <span></span> {{ $product->name ?? '' }}
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">

                                        @foreach ($productImages as $productImage)
                                            <figure class="border-radius-10">
                                                <img src="{{ asset($productImage->product_image) }}"
                                                    alt="{{ $productImage->product_image_alt ?? '' }}"
                                                    longdesc="{{ $productImage->product_image_des ?? '' }}">
                                            </figure>
                                        @endforeach


                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                        @foreach ($productImages as $productImage)
                                            <div><img
                                                    src="{{ asset($productImage->product_image_thumb ?? $productImage->product_image) }}"
                                                    alt="{{ $productImage->product_image_alt ?? '' }}"
                                                    longdesc="{{ $productImage->product_image_des ?? '' }}"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    @foreach ($stock_status as $status)
                                        <span class="stock-status out-stock">
                                            {{ $status->stock_status }}
                                        </span>
                                    @endforeach
                                    <h2 class="title-detail">{{ $product->name ?? '' }}</h2>
                                    <div class="product-detail-rating">
                                        <div class="product-rate-cover text-end">
                                            <div class="d-inline-block">
                                                <div style="width: 90%;">

                                                    @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                        ★★★★★

                                                    @elseif($AverageRating >= 3.5 && $AverageRating < 4.5) ★★★★
                                                        @elseif($AverageRating>= 2.5 && $AverageRating < 3.5) ★★★
                                                            @elseif($AverageRating>= 1.5 && $AverageRating < 2.5) ★★
                                                                @elseif($AverageRating>= 0.5 && $AverageRating < 1.5) ★
                                                                        @endif


                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $rating_count ?? 0 }}
                                                reviews)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">

                                            <span class="current-price text-brand">
                                                ৳{{ $product->discount_price ?? $product->sell_price }}
                                            </span>

                                            <span>
                                                @if ($product->discount)
                                                    <span class="save-price  font-md color3 ml-15">
                                                        {{ $product->discount ?? '' }}% Off
                                                    </span>
                                                    <span class="old-price font-md ml-15">
                                                        ৳{{ $product->sell_price ?? '' }}
                                                    </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="short-desc mb-30">
                                        <p class="font-lg">{{ $product->meta_des ?? '' }}</p>
                                    </div>


                                    <form id="OrderDetails">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @if (count($productSizes) > 0)




                                            <div class="attr-detail attr-size mb-30">
                                                <strong class="mr-10">Size: </strong>

                                                <select name="size" id="" class="form-control w-50">
                                                    @foreach ($productSizes as $productSize)
                                                        <option value="{{ $productSize->size->name ?? '' }}">
                                                            {{ $productSize->size->name ?? '' }}</option>
                                                    @endforeach
                                                </select>

                                                <!-- <ul class="list-filter size-filter font-small">

                                                                        @php $i=0 @endphp
                                                                        @foreach ($productSizes as $productSize)
                                                                            <?php
                                                                            $actives = '';
                                                                            if ($i == 0) {
                                                                                $actives = 'active';
                                                                            }
                                                                            ?>

                                                                            <li class="{{ $actives }}">
                                                                            <a href="#">{{ $productSize->size->name ?? '' }}</a></li>

                                                                            @php $i++; @endphp
                                                                            @endforeach
                                                                        </ul> -->
                                            </div>
                                        @endif

                                        @if (count($productColors) > 0)
                                            <div class="attr-detail attr-size mb-30">
                                                <strong class="mr-10">Color: </strong>

                                                <select name="color" id="" class="form-control w-50">
                                                    @foreach ($productColors as $productColor)
                                                        <option value="{{ $productColor->color->name ?? '' }}">
                                                            {{ $productColor->color->name ?? '' }}</option>
                                                    @endforeach
                                                </select>

                                                <!-- <ul class="list-filter size-filter font-small">
                                                                            @php $i=0 @endphp
                                                                        @foreach ($productColors as $productcolor)

                                                                            <?php
                                                                            $actives = '';
                                                                            if ($i == 0) {
                                                                                $actives = 'active';
                                                                            }
                                                                            ?>
                                                                            <li class="{{ $actives }}">
                                                                            <a href="#">{{ $productcolor->color->name ?? '' }}</a></li>
                                                                                @php $i++; @endphp
                                                                            @endforeach
                                                                        </ul> -->
                                            </div>
                                        @endif

                                        <div class="detail-extralink mb-50">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i
                                                        class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">1</span>

                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                <input type="hidden" name="quantity" value="1" class="qty-val-input">

                                            </div>
                                            <div class="product-extra-link2">

                                                <button type="submit" class="AddCart button button-add-to-cart"
                                                    data-id="{{ $product->id }}"><i class="fi-rs-shopping-cart"></i>Add
                                                    to
                                                    cart
                                                </button>

                                                @if ($user_id)
                                                    <a aria-label="Add To Wishlist" class="action-btn AddWishlist" href=""
                                                        data-id="{{ $product->id }}"><i class="fi-rs-heart"></i></a>
                                                @else
                                                    <a aria-label="Add To Wishlist" class="action-btn"
                                                        href="{{ route('login') }}"><i class="fi-rs-heart"></i></a>
                                                @endif


                                            </div>
                                        </div>

                                    </form>





                                    <div class="font-xs">
                                        <ul class="mr-50 float-start">

                                            @if (count($productBrands) > 0)
                                                <li class="mb-5">Brand:
                                                    @foreach ($productBrands as $productBrand)
                                                        <span
                                                            class="text-brand">{{ $productBrand->brand->name ?? '' }}</span>
                                                    @endforeach
                                                </li>
                                            @endif

                                            @if ($product->code)
                                                <li class="mb-5">Code:<span class="text-brand">
                                                        {{ $product->code ?? '' }}</span></li>
                                            @endif

                                            <li>Stock:<span class="in-stock text-brand ml-5">{{ $product->qty ?? '' }}
                                                    Items In Stock</span></li>
                                        </ul>
                                        <ul class="float-start">
                                            <li class="mb-5">SKU: <a href="#">{{ $product->sku ?? '' }}</a>
                                            </li>

                                            <li class="mb-5">Categoris:
                                                @foreach ($ProductCategories as $ProductCategory)
                                                    <a href="{{ route('/', [$ProductCategory->category->slug ?? '']) }}"
                                                        rel="tag">{{ $ProductCategory->category->name ?? '' }}</a>,
                                                @endforeach
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                            href="#Additional-info">Specification</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                                            href="#Reviews">Reviews ({{ $rating_count ?? 0 }})</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <table class="font-md">
                                            <tbody>
                                                @foreach ($ProductSpecifications as $specification)
                                                    <tr class="stand-up">
                                                        <td>
                                                            <p>{{ $specification->specification ?? '' }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                        <!--Comments-->
                                        <div class="comments-area">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <h4 class="mb-30">Customer questions & answers</h4>
                                                    <div class="comment-list">


                                                        @foreach ($ratings as $rating)
                                                            <div
                                                                class="single-comment justify-content-between d-flex mb-30">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <a href="#"
                                                                            class="font-heading text-brand">{{ $rating->name }}</a>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="d-flex justify-content-between mb-10">
                                                                            <div class="d-flex align-items-center">
                                                                                <span class="font-xs text-muted">

                                                                                    <?php echo date('d-m-Y', strtotime($rating->created_at)); ?>

                                                                                    <?php
                                                                                    $currentDateTime = $rating->created_at;
                                                                                    echo $newDateTime = date('h:i A', strtotime($currentDateTime));
                                                                                    ?>

                                                                                </span>
                                                                            </div>

                                                                            <div class="d-inline-block">

                                                                                @if ($rating->rate == 5)
                                                                                    ★★★★★
                                                                                @endif

                                                                                @if ($rating->rate == 4)
                                                                                    ★★★★
                                                                                @endif

                                                                                @if ($rating->rate == 3)
                                                                                    ★★★
                                                                                @endif

                                                                                @if ($rating->rate == 2)
                                                                                    ★★
                                                                                @endif

                                                                                @if ($rating->rate == 1)
                                                                                    ★
                                                                                @endif

                                                                            </div>
                                                                        </div>
                                                                        <p class="mb-10">{!! $rating->comment !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach


                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <h4 class="mb-30">Customer reviews</h4>
                                                    <div class="d-flex mb-30">
                                                        <div class=" d-inline-block mr-15">
                                                            <div class="" style="width: 90%">

                                                                @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                                    ★★★★★

                                                                @elseif($AverageRating >= 3.5 && $AverageRating < 4.5)
                                                                    ★★★★ @elseif($AverageRating>= 2.5 && $AverageRating
                                                                    < 3.5) ★★★ @elseif($AverageRating>= 1.5 &&
                                                                        $AverageRating < 2.5) ★★ @elseif($AverageRating>
                                                                                = 0.5 && $AverageRating < 1.5) ★
                                                                                    @endif

                                                            </div>
                                                        </div>
                                                        <h6>{{ $AverageRating ?? 1 }} out of 5</h6>
                                                    </div>
                                                    <div class="progress">
                                                        <span>5 star</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $fivestar }}%;"
                                                            aria-valuenow="{{ $fivestar }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $fivestar }}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>4 star</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $fourstar }}%;"
                                                            aria-valuenow="{{ $fourstar }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $fourstar }}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 star</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $threestar }}%;"
                                                            aria-valuenow="{{ $threestar }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $threestar }}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>2 star</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $twostar }}%;"
                                                            aria-valuenow="{{ $twostar }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $twostar }}%</div>
                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 star</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ $onestar }}%;"
                                                            aria-valuenow="{{ $onestar }}" aria-valuemin="0"
                                                            aria-valuemax="100">{{ $onestar }}%</div>
                                                    </div>
                                                    <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--comment form-->

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ol>
                                                    @foreach ($errors->all() as $error)
                                                        <li style="font-size: 12px">{{ $error }}</li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        @endif

                                        @if (session()->has('submit_rating'))
                                            <div class="alert alert-success">
                                                <strong
                                                    style="font-size: 12px">{{ session()->get('submit_rating') }}</strong>
                                            </div>
                                        @endif

                                        @if (session()->has('login'))
                                            <div class="alert alert-warning">
                                                <strong style="font-size: 12px">{{ session()->get('login') }}</strong>
                                            </div>
                                        @endif


                                        <form class="form-contact comment_form" action="{{ route('submit-your-rate') }}"
                                            method="post" id="commentForm">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <div class="comment-form">
                                                <h4 class="mb-15">Add a review</h4>
                                                <div class=" d-inline-block mb-30">
                                                    <select name="rate" id="" required="">
                                                        <option value="5">★★★★★</option>
                                                        <option value="4">★★★★</option>
                                                        <option value="3">★★★</option>
                                                        <option value="2">★★</option>
                                                        <option value="1">★</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control w-100" name="comment"
                                                                        id="comment" cols="30" rows="9"
                                                                        placeholder="Write Comment" required=""></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="name" id="name"
                                                                        type="text" placeholder="Name" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="email" id="email"
                                                                        type="email" placeholder="Email" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" name="website"
                                                                        id="website" type="text" placeholder="Website">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="button button-contactForm">Submit
                                                                Review</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">

                                    @foreach ($relatedProducts as $product)
                                        <?php
                                        $stock_status = App\Models\ProductStockStatus::where('product_id', $product->id)->get();
                                        ?>

                                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap mb-30">
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
                                                            <a aria-label="Add To Wishlist" class="action-btn AddWishlist"
                                                                href="" data-id="{{ $product->id }}"><i
                                                                    class="fi-rs-heart"></i></a>
                                                        @else
                                                            <a aria-label="Add To Wishlist" class="action-btn"
                                                                href="{{ route('login') }}"><i
                                                                    class="fi-rs-heart"></i></a>
                                                        @endif

                                                        <a aria-label="Quick view"
                                                            class="action-btn open-product-details-popup"
                                                            data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                            data-id="{{ $product->id }}"><i
                                                                class="fi-rs-eye"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        @foreach ($stock_status as $status)
                                                            <span
                                                                class="hot">{{ $status->stock_status }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <div class="product-category">
                                                        <!-- <a href="shop-grid-right.html">Snack</a> -->
                                                    </div>
                                                    <h2><a
                                                            href="{{ route('/', [$product->slug]) }}">{{ Str::limit($product->name, 18) }}</a>
                                                    </h2>
                                                    <div class="product-rate-cover">
                                                        <div class=" d-inline-block">
                                                            @if ($AverageRating >= 4.5 && $AverageRating <= 5)

                                                                ★★★★★

                                                            @elseif($AverageRating >= 3.5 && $AverageRating < 4.5) ★★★★
                                                                @elseif($AverageRating>= 2.5 && $AverageRating < 3.5)
                                                                    ★★★ @elseif($AverageRating>= 1.5 && $AverageRating <
                                                                        2.5) ★★ @elseif($AverageRating>= 0.5 &&
                                                                        $AverageRating < 1.5) ★ @else ★ @endif
                                                        </div>
                                                        <span class="font-small ml-5 text-muted">
                                                            ({{ $AverageRating ?? 1 }})</span>
                                                    </div>
                                                    <div>
                                                        <div class="sold mt-15 mb-15">
                                                            <div class="progress mb-5">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $product->total_sell }}%"
                                                                    aria-valuemin="0"
                                                                    aria-valuemax="{{ $product->qty }}">
                                                                </div>
                                                            </div>
                                                            <span class="font-xs text-heading"> Sold:
                                                                {{ $product->total_sell }}/{{ $product->qty }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-card-bottom">
                                                        <div class="product-price">
                                                            <span>৳{{ $product->discount_price ?? $product->sell_price }}</span>


                                                            @if ($product->discount_price)
                                                                <span
                                                                    class="old-price">৳{{ $product->sell_price ?? '' }}</span>
                                                            @endif

                                                        </div>
                                                        <div class="add-cart AddCart" data-id="{{ $product->id }}">
                                                            <a class="add" href="" id="AddToCartBtn"><i
                                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>

                                                            <div class="text-center" id="AddCartLoaderGif"
                                                                style="display: none">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>









@stop
