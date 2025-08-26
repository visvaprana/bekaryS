@extends('frontend.layouts.app')


@section('head')
    <title>Menus - {{ $site_seo->meta_title }}</title>

@endsection

@section('content')

    <main>

        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->menu_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Menus</h1>
                            <!-- <p>Cooking delicious and tasty food since 2005</p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->


        <div class="pattern_2">
            <div class="container margin_60_40" data-cues="slideInUp">
           



        @foreach($categories as $category)
            <?php 
                $products = App\Models\Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                                ->where('product_categories.category_id', $category->id)
                                ->where('products.status', 1)
                                ->select('products.*', 'product_categories.category_id', 'product_categories.product_id')
                                ->take(8)
                                ->get();
                                
               
            ?>
            
            @if(count($products) > 0)
            <section class="daily-menu-section">
                <div class="container">
                <div class="pb-4 menu-title text-center">
                <img  src="{{asset($category->image)}}" class="pb-2" alt="">
                    <h2 class="text-center">{{$category->name ?? ''}}</h2>
                </div>
                <div class="row g-4">
                    
                    @foreach($products as $product)
                    <div class=" col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100">
                        <img src="{{ asset($product->product_image_small) }}" class="card-img-top" alt="{{$product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($product->name, 23) }}</h5>
                            <div class="d-flex justify-content-between ">
                            <h6 class="card-text d-inline-block">
                                Price: ৳{{ $product->discount_price ?? $product->sell_price }}
                                @if ($product->discount_price)
                                    <span class="old_price">৳{{ $product->sell_price ?? '' }}</span>
                                @endif
                            </h6>
                            
                            
                            
                            <button class="add_cart AddCart" data-id="{{ $product->id }}">Add to Cart</button>
                            </div>
                        </div>
                        </div>
                    </div><!-- /col -->
                    @endforeach
                    
                </div>
                
                @if(count($products) > 8)
                <div class="pb-4 view-more-btn text-center py-4">
                    <a href="{{ route('items', $category->slug) }}"> <button>View More</button> </a>    
                </div>
                @endif
            </div>
            </section>
            @endif
        @endforeach



        
       
        

       </div>
        <!-- /pattern_2 -->
    </main>

@stop
