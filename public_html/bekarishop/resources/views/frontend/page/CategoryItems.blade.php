@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    $social_link = App\Models\SiteSocialLink::first();
    $siteInfo = App\Models\Siteinfo::first();
    ?>
    <title> Contact - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')



    <main>

        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->contact_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <!--<img  src="{{asset($category->image)}}" class="pb-2" alt="">-->
                            <h1>{{$category->name ?? ''}}</h1>
                            <!-- <p>Per consequat adolescens ex cu nibh commune</p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>

        
        
        

        <section class="daily-menu-section">
            <div class="container">
       
            <div class="row g-4">
                
                @forelse($products as $product)
                    @include('frontend.layouts.item_cart')
                @empty
                <div class=" col-sm-12 col-md-12 col-lg-12">
                    <div class="text-center mb-5">
                        <h5>No Products Found !!</h5>
                    </div>
                </div><!-- /col -->
                @endforelse
                
            </div>
            
    
        </div>
        </section>

        
        
        
   
        
    </main>




@stop
