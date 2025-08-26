@extends('frontend.layouts.app')


@section('head')
    <title>{{ $site_seo->meta_title }}</title>
    <meta name="title" content="{{ $site_seo->meta_title }}">
    <meta name="description" content="{{ $site_seo->meta_des }}">
    <meta name="keywords" content="{{ $site_seo->meta_keywords }}" />
    <meta property="type" content="Website" />
    <link rel="canonical" href="{{ $site_seo->canonical }}" />
    <meta name="robots" content="{{ $site_seo->robots }}" />
    <meta property="site_name" content="{{$site_info->site_name}}" />
    <meta property="image" content="{{$domain}}{{ $site_seo->meta_image }}" />

    <meta property="og:url" content="{{$domain}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $site_seo->meta_title }}" />
    <meta property="og:description" content="{{ $site_seo->meta_des }}" />
    <meta property="og:keywords" content="{{ $site_seo->meta_keywords }}" />
    <meta property="og:image" content="{{$domain}}{{ $site_seo->meta_image }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@ {{$site_info->site_name}}" />
    <meta name="twitter:creator" content="@ {{$site_info->site_name}}" />
    <meta property="twitter:url" content="{{$domain}}" />
    <meta property="twitter:title" content="{{ $site_seo->meta_title }}" />
    <meta property="twitter:description" content="{{ $site_seo->meta_des }}" />
    <meta property="twitter:keywords" content="{{ $site_seo->meta_keywords }}" />
    <meta property="twitter:image" content="{{$domain}}{{ $site_seo->meta_image }}" />


@endsection

@section('content')

    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">

                @foreach ($banners as $banner)
                <div class="owl-slide cover lazy" data-bg="url({{ asset($banner->image) }}">
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div class="container">
                            <div class="row justify-content-center justify-content-md-end">
                                <div class="col-lg-6 static">
                                    <div class="slide-text text-right white">
                                        <h2 class="owl-slide-animated owl-slide-title">{!! $banner->title ?? '' !!}</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            {!! $banner->subscribe_title ?? '' !!}
                                        </p>
                                        
                                        @if($banner->btn_txt)
                                            <div class="owl-slide-animated owl-slide-cta"><a class="btn_1 btn_scroll" href="{{ $banner->url ?? '' }}" role="button">{{ $banner->btn_txt ?? '' }}</a></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->

        <ul id="banners_grid" class="clearfix">
            <li>
                <a href="{{route('menus')}}" class="img_container">
                    <img src="{{ asset($site_image->menu_home_image ?? '') }}" data-src="{{ asset($site_image->menu_home_image ?? '') }}" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Our Menu</h3>
                        <p>View Our Specialites</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('facilities')}}" class="img_container">
                    <img src="{{ asset($site_image->reserv_home_image ?? '') }}" data-src="{{ asset($site_image->reserv_home_image ?? '') }}" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Our Facilities</h3>
                        <p>View Our Facilities </p>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('gallery')}}" class="img_container">
                    <img src="{{ asset($site_image->gallery_home_image ?? '') }}" data-src="{{ asset($site_image->gallery_home_image ?? '') }}" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>Inside {{$site_info->site_name}}</h3>
                        <p>View the Gallery</p>
                    </div>
                </a>
            </li>
        </ul>
        <!--/banners_grid -->
        
        
        
           <!-- start:: gobindas welcome section-->
         <section class="welcome-gobindas-section">
            <div class="container">
                <div class="gobindas-welcome-title text-center py-5">
                    <h2>Welcome To Govindas Restaurant </h2>
                    <h5>100 % Vegetarian and Vegan Restaurant </h5>
                </div>
                <div class="row ">
                    <div class="col-12">
                        <div class="welcome-givindas-main">
                        <div class="gobindas-welcome-img">
                            <img src="{{ asset($site_info->welcome_resturant_image) }}" alt="">
                        </div>

                        <div class="gobindas-welcome-text">
                            <p>{!! $site_info->welcome_resturant_description  ?? '' !!}</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>
         <!-- end:: gobindas welcome section  -->
        
        
         <!-- start:: health food card section -->
         <section class="helath-card-section py-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                    <div class="health-food-card">
                        <div class="carve-img text-center">
                            <h6 class="text-center">SATTVIC</h6>
                        <img  src="{{asset('images/gallery_image/carv-1.png')}}" class="pb-2" alt="">
                        </div>
                        <div class="carv-text text-center">
                            <p>Light and healthy foods are known in Ayurvedic practice to help increase energy, happiness and mental clarity. </p>
                        </div>
                    </div>
                    </div><!-- ./col -->
                    <div class="col-lg-4">
                    <div class="health-food-card">
                        <div class="carve-img text-center">
                            <h6 class="text-center"> Vegetarian</h6>
                        <img  src="{{asset('images/gallery_image/carv-2.png')}}" class="pb-2" alt="">
                        </div>
                        <div class="carv-text text-center">
                            <p> Clean, nutritious and pure vegetarian Indian cuisine that also tastes badiya! Open all day for breakfast, lunch and dinner. </p>
                        </div>
                    </div>
                    </div><!-- ./col -->
                    <div class="col-lg-4">
                    <div class="health-food-card">
                        <div class="carve-img text-center">
                            <h6 class="text-center">Healthy</h6>
                        <img  src="{{asset('images/gallery_image/carv-1.png')}}" class="pb-2" alt="">
                        </div>
                        <div class="carv-text text-center">
                            <p> Freshly prepared daily, including oil-free mains and sweets made with only good fats so you can eat worry-free. </p>
                        </div>
                    </div>
                    </div><!-- ./col -->
                </div>
            </div>
         </section>
         <!-- end:: health food card section -->
        
        
        
        
        @foreach($allcategories as $category)
            <?php 
                $products = App\Models\Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                                ->where('product_categories.category_id', $category->id)
                                ->where('products.status', 1)
                                ->select('products.*', 'product_categories.category_id', 'product_categories.product_id')
                                ->get();
                                
               
            ?>
            
            @if(count($products) > 0)
            <section class="daily-menu-section">
                <div class="container">
                <div class="pb-4 menu-title text-center">
                <img  src="{{asset($category->image)}}" class="pb-2" alt="">
                    <h2 class="text-center">{{$category->name ?? ''}}</h2>
                    <p class="text-center" style="font-size: 15px;margin-bottom: 0">{!! $category->description ?? '' !!}</p>
                </div>
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
            @endif
        @endforeach
        
        
        
        
        
        

        <!-- start:: catering section -->
        <section class="daily-menu-section pb-5">
            <div class="container">
                <div class="pb-4 menu-title">
                    <h1 class="text-center fs-bold">Catering</h2>
                    <p class="text-center fz-5">{!! $site_info->catering_title  ?? '' !!}</p>
                </div>
                <div class="cataring-wrapper">
                    <div class="catering-form">
                        
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ol>
                                @foreach ($errors->all() as $error)
                                    <li style="font-size: 12px">{{ $error }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif

                    @if (session()->has('notif'))
                        <div class="alert alert-success">
                            <strong style="font-size: 12px">{{ session()->get('notif') }}</strong>
                        </div>
                    @endif
                        
                    <form method="post" action="{{route('send-message')}}" id="contactform" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Name" id="name_contact" name="name" required="">
                        </div>
                        <!-- <div class="form-group">
                            <input class="form-control" type="email" placeholder="Email" id="email_contact" name="email" required="">
                        </div> -->
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Phone Number" name="phone" required="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Address" name="address" required="">
                        </div>
                        
                        <div class="form-group">
                            
                            <select class="form-control" name="type" required="">
                                <option value=""> Select </option>
                                <option value="Marriage"> Marriage </option>
                                <option value="Birthday"> Birthday </option>
                                
                                <option value="Inquiry"> Inquiry </option>
                                <option value="Other"> Other </option>
                                
                            </select>
                            
                        </div>
                        
                        <div class="form-group">
                            <textarea class="form-control" style="height: 100px;" placeholder="Message" id="message_contact" name="message" required=""></textarea>
                        </div>
                        
                        <div class="form-group">
                            <input class="btn_1 full-width" type="submit" value="Submit" id="submit-contact">
                        </div>
                    </form>
                    </div>
                        <div class="catering-img">
                            <img src="{{asset('images/gallery_image/catering-img.jpg')}}" alt="">
                        </div>
                </div>
                
            </div>
        </section>
        <!-- end:: Catering section -->

        
        
        
        
        
        
        


        <!--<div class="bg_gray">-->
        <!--    <div class="container margin_120_100" data-cue="slideInUp">-->
        <!--        <div class="main_title center mb-5">-->
        <!--            <span><em></em></span>-->
        <!--            <h2>Our Daily Menu</h2>-->
        <!--        </div>-->
                <!-- /main_title -->
        <!--        <div class="banner lazy" data-bg="url({{ asset($site_image->reserv_banner_home_image ?? '') }}">-->
        <!--            <div class="wrapper d-flex align-items-center justify-content-between opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">-->
        <!--                <div>-->
                            <!--<small>Menus</small>-->
        <!--                    <h3> Our Menus </h3>-->
        <!--                    <p>-->
        <!--                        @php $i=1 @endphp-->
                                <?php
                                    $allcat = count($allcategories) ;
                                ?>
                                
                <!--                @foreach($allcategories as $category)-->
                <!--                    {{$category->name}}-->
                                    
                <!--                    @if($i < $allcat)-->
                <!--                    ,-->
                <!--                    @else-->
                <!--                    .-->
                <!--                    @endif    -->
                                
                                    
                <!--                    @php $i++; @endphp-->
                <!--                @endforeach-->
                <!--            </p>-->
                <!--            <a href="{{route('reservation')}}" class="btn_1">See Menu</a>-->
                <!--        </div>-->
                <!--    </div>-->
                    <!-- /wrapper -->
                <!--</div>-->
                <!-- /banner -->




                                
                <!--@if(count($galleries) > 0)-->
                <!--<div class="bg_gray">-->
                <!--    <div class="container margin_60_40">-->
                <!--        <div class="main_title center">-->
                <!--            <span><em></em></span>-->
                <!--            <h2>Our Gallery</h2>-->
                     
                <!--        </div>-->
                <!--        <div class="grid">-->
                <!--            <ul class="magnific-gallery clearfix">-->
        
                <!--                @foreach($galleries as $gallery)-->
                <!--                <li style="padding: 10px;">-->
                <!--                    <div class="item">-->
                <!--                        <div class="item-img" data-cue="slideInUp">-->
                <!--                            <img src="{{ asset($gallery->image) }}" alt="{{$gallery->title ?? ''}}">-->
                <!--                            <div class="content">-->
                <!--                                <a href="{{ asset($gallery->image) }}" title="{{$gallery->title ?? ''}}" data-effect="mfp-zoom-in"><i class="arrow_expand"></i></a>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </li>-->
                <!--                @endforeach-->
        
                <!--            </ul>-->
                <!--        </div>-->
                        <!-- /grid gallery -->
                <!--    </div>-->
                    <!-- /container -->
                <!--</div>-->
                <!--@endif-->
                <!-- /bg_gray -->
            
                    
                    
            






            <!--</div>-->
            <!-- /container -->
        <!--</div>-->
        <!-- /bg_gray -->

        <!--<div class="call_section lazy" data-bg="url({{ asset($site_image->contact_banner_home_image ?? '') }}">-->
        <!--    <div class="container clearfix">-->
        <!--        <div class="row justify-content-center">-->
        <!--            <div class="col-lg-5 col-md-6 text-center">-->
        <!--                <div class="box_1" data-cue="slideInUp">-->
        <!--                    <h2>Celebrate<span>a Special Event with us!</span></h2>-->
                            
        <!--                    <a href="{{route('contact')}}" class="btn_1 mt-3">Contact us</a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--/call_section-->


        <!-- /pattern_2 -->
    </main>
    <!-- /main -->

@stop
