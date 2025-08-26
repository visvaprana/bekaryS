<?php
    $site_image = App\Models\SiteImage::first();
    $page_categories = App\Models\Page_category::where('status', 1)->take(4)->get();
    $siteInfo = App\Models\Siteinfo::first();
    $social_link = App\Models\SiteSocialLink::first();
    $payment_methods = App\Models\PaymentMethod::where('status', 1)->get();
    $user_id = Session::get('user_id');
?>

    <footer>
        <div class="frame black"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp footer-content-wrapper">
                        
                        <a href="{{ URL::to('/') }}"><img src="{{ asset($site_image->logo) }}" width="" height="" alt="" style="width: 200px;"></a>
                    </div>
                    <div class="footer-logo-text py-2 footer-content-wrapper">
                        <p class="text-white"> {!! $siteInfo->footer_description !!} </p>
                    </div>
                        <div class="footer-social-icon footer-content-wrapper">
                        <a href="#"><i class="fab fa-facebook"></i></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="text-white footer-content-wrapper">
                        <h3> Quick Links </h3>
                   
                        <a href="{{URL::to('/')}}"> <p>Home</p> </a>
                        <a href="{{route('menus')}}"> <p>Menu</p> </a>
                        <a href="{{route('gallery')}}"> <p>Gallery</p> </a>
                        <a href="{{route('contact')}}"> <p>Contact US</p> </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp text-white footer-content-wrapper">
                        
                        <span class="pr-2"> <i class="icon_clock_alt text-white"></i> </span>
                       
                       <h3 class="d-inline-block px-3"> Opening Hours</h3>
                       <ul>
                           <li>{{$siteInfo->opening_hours ?? ''}}</li>
                           <li>{{$siteInfo->resturant_close ?? ''}}</li>
                       </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <!-- <h3>Keep in touch</h3>
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="{{route('subscription')}}" name="newsletter_form" id="newsletter_form">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" id="email_newsletter" class="form-control" placeholder="Your email">
                                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div> -->

                    <div class="footer_wp text-white footer-content-wrapper">
                       <span class="pr-2"> <i class="icon_pin_alt text-white"></i></span>
                        <h3 class="d-inline-block px-3">Address</h3>

                        <p class="">{!! $siteInfo->address !!}</p>
                        
                        <span class="pr-1"> <i class="icon_coll_alt text-white"></i></span>
                        <p class="d-inline-block">Phone: {!! $siteInfo->phone !!}</p>
              

                        <div class="chat-icon text-center">
                            <a href="https://api.whatsapp.com/send/?phone=8801732934028&text=Is+anyone+available+to+chat%3F&type=phone_number&app_absent=0" target="_blank">   <i class="icon_comment_alt text-white"></i></a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row">
                <div class="col-sm-12 text-center text-white footer-copyright">
                    <p class="copy text-white">Copyright © <?php echo date('Y'); ?> <a class="text-white" href="https://www.thaiparkrestaurent.com/">{{ $siteInfo->site_name }}</a>  Restaurant, All Rights Reserved || Developed By - <a href="https://branexitltd.com/" target="_blank"><b class="text-white">Branex IT LTD</b></a> </p>
                </div>
                <!-- <div class="col-sm-7">
                    <div class="follow_us">
                        <ul>

                            <li><a href="{{$social_link->twitter}}"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('assets/frontend/') }}/img/twitter_icon.svg" alt="" class="lazy"></a></li>


                            <li><a href="{{$social_link->facebook}}"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('assets/frontend/') }}/img/facebook_icon.svg" alt="" class="lazy"></a></li>


                            <li><a href="{{$social_link->instagram}}"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('assets/frontend/') }}/img/instagram_icon.svg" alt="" class="lazy"></a></li>


                            <li><a href="{{$social_link->youtube}}"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('assets/frontend/') }}/img/youtube_icon.svg" alt="" class="lazy"></a></li>

                        </ul>
                    </div>
                  </div> -->
             </div>
        </div>
    </footer>
    <!--/footer-->