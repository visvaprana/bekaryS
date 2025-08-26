@extends('frontend.layouts.app')


@section('head')
    <title> Blog - {{ $site_seo->meta_title }}</title>
@endsection


@section('content')

    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->blog_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>{{ $site_info->site_name }} Blog</h1>
                            <!-- <p>Per consequat adolescens ex cu nibh commune</p> -->
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
                <div class="col-lg-12">
                    <div class="row">

                        @foreach ($posts as $post)
                        <div class="col-md-4" data-cue="slideInUp">
                            <article class="blog">
                                <figure>
                                    <a href="{{ route('/', [$post->slug]) }}"><img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                                        <div class="preview"><span>Read more</span></div>
                                    </a>
                                </figure>
                                <div class="post_info">
                                    <small>Date - <?php echo date('d-m-Y', strtotime($post->created_at)); ?></small>
                                    <h2><a href="{{ route('/', [$post->slug]) }}">{{ Str::limit($post->title, 50) }}</a></h2>
                                    <p>{{ Str::limit($post->meta_description, 100) }}</p>
                                    <ul>
                                        <li>
                                            
                                        </li>
                                        <li><i class="icon_comment_alt"></i><?php echo $post->created_at->diffForHumans(); ?></li>
                                    </ul>
                                </div>
                            </article>
                            <!-- /article -->
                        </div>
                        @endforeach

                    </div>
                    <!-- /row -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->   
        </div>
        <!-- /container -->
    </main>

@stop
