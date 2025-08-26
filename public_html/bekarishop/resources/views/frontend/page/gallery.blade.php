@extends('frontend.layouts.app')


@section('head')
    <title>Gallery - {{ $site_seo->meta_title }}</title>

@endsection

@section('content')


    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->gallery_banner ?? '') }})">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Media Gallery</h1>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame gray"></div>
        </div>
        <!-- /hero_single -->



        @if(count($galleries) > 0)
        <div class="bg_gray">
            <div class="container margin_60_40">
                <div class="main_title center">
                    <span><em></em></span>
                    <h2>Our Gallery</h2>
             
                </div>
                <div class="grid">
                    <ul class="magnific-gallery clearfix">

                        @foreach($galleries as $gallery)
                        <li style="padding: 10px;">
                            <div class="item">
                                <div class="item-img" data-cue="slideInUp">
                                    <img src="{{ asset($gallery->image) }}" alt="{{$gallery->title ?? ''}}">
                                    <div class="content">
                                        <a href="{{ asset($gallery->image) }}" title="{{$gallery->title ?? ''}}" data-effect="mfp-zoom-in"><i class="arrow_expand"></i></a>
                                    </div>
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
        @endif



    </main>



@stop
