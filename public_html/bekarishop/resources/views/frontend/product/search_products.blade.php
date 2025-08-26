@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    $site_image = App\Models\SiteImage::first();
    ?>
    <title>Search - {{ $site_seo->meta_title }}</title>
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
                            <h1>{{$product_name ?? ''}}</h1>
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

            <section class="daily-menu-section">
                <div class="container">
                    <div class="row g-4">
                        
                        @foreach($products->take(8) as $product)
                            @include('frontend.layouts.item_cart')
                        @endforeach
                        
                    </div>
                    
                    @if(count($products) > 8)
                    <div class="pb-4 view-more-btn text-center py-4">
                        <a href="{{ route('items', $category->slug) }}"> <button>View More</button> </a>    
                    </div>
                    @endif
                </div>
            </section>
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
