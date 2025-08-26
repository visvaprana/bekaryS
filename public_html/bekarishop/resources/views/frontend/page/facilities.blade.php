@extends('frontend.layouts.app')


@section('head')
    <title>Facilities - {{ $site_seo->meta_title }}</title>

@endsection

@section('content')


    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->facility_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>{{ $site_info->site_name }} Facilities</h1>
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
                
                <div class="grid">
                    <ul class="magnific-gallery clearfix">

                        @foreach($services as $service)
                        <li>
                            <div class="item" style="margin: 12px;">
                                <div class="item-img" data-cue="slideInUp">
                                    <img src="{{ asset($service->image) }}" alt="{{$service->title ?? ''}}">
                                    <div class="content">
                                        <a href="{{ asset($service->image) }}" title="{{$service->title ?? ''}}" data-effect="mfp-zoom-in"><i class="arrow_expand"></i></a>
                                    </div>

                                    <article class="blog">
                                        <div class="post_info">
                                            <h2><a href="{{ route('/', [$service->slug]) }}">{{ Str::limit($service->title, 15) }}</a></h2>
                                        </div>
                                    </article>

                                    
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <!-- /grid gallery -->
            </div>
            <!-- /container -->
        </div>
   


    </main>



@stop
