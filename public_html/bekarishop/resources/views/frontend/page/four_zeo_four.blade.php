@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title>Not Found - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')


    <main>
       <div id="error_page">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-7 col-lg-9">
                        <figure><img src="img/404.svg" alt="" class="img-fluid"></figure>
                        <p>We're sorry, but the page you were looking for doesn't exist.</p>
                        <form action="{{ route('search') }}" role="search" id="searchform" method="post">
                            @csrf
                            <div class="search_bar">
                                <input type="text" class="form-control" name="product_name" placeholder="What are you looking for?">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /error --> 
    </main>


@stop
