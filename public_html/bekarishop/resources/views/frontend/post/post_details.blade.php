@extends('frontend.layouts.app')
@section('content')




    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{asset($post->image)}})">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>{{$post->title}}</h1>
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
                    <div class="singlepost">
                        <figure><img alt="" class="img-fluid" src="img/blog-single.jpg"></figure>
                        <h1>{{$post->title}}</h1>
                        <div class="postmeta">
                            <ul>
                                <!-- <li><a href="#"><i class="icon_folder-alt"></i> Category</a></li> -->
                                <li><i class="icon_calendar"></i> <?php echo date('d-m-Y', strtotime($post->created_at)); ?></li>
                                <li><a href="#"><i class="icon_pencil-edit"></i> <?php echo $post->created_at->diffForHumans();?> </a></li>
                            </ul>
                        </div>
                        <!-- /post meta -->
                        <div class="post-content">
                            <div class="dropcaps">
                                {!! $post->description !!}
                            </div>

                       
                        </div>
                        <!-- /post -->
                    </div>
                    <!-- /single-post -->

                
                    <hr>

                    <!-- <h5>Leave a comment</h5> -->
                    
                    <div class="form-group">
                        <!--Comment form-->
                        <div class="comment-form">
                            <h3 class="mb-15 text-center mb-30">Leave a Comment</h3>
                            <div class="row">
                                <div class="col-lg-9 col-md-12  m-auto">
                                    <div class="fb-comments" data-href="{{$social->facebook}}" data-width="" data-numposts="5"></div>
                                    <!--<div class="fb-comments" data-href="https://www.facebook.com/thaipark2017/" data-width="" data-numposts="5"></div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <!-- /col -->

            </div>
            <!-- /row -->   
        </div>
        <!-- /container -->
    </main>




@stop
