@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title>{{ $page->title }} - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')

<div class="ps-about mar-top-page">
    <div class="container">
        <ul class="ps-breadcrumb">
            <li class="ps-breadcrumb__item"><a href="{{URL::to('/')}}">Home</a></li>
            <li class="ps-breadcrumb__item active" aria-current="page">{{ $page->title }}</li>
        </ul>
       
    </div>
    <div class="ps-about__content">
        
        <section class="ps-about__project">
            <div class="container">
                {!! $page->content !!}
            </div>
        </section>
       
    </div>
   
</div>

@stop
