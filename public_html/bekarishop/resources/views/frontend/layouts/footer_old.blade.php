<?php
    $site_image = App\Models\SiteImage::first();
    $page_categories = App\Models\Page_category::where('status', 1)->take(4)->get();
    $siteInfo = App\Models\Siteinfo::first();
    $social_link = App\Models\SiteSocialLink::first();
    $payment_methods = App\Models\PaymentMethod::where('status', 1)->get();
    $user_id = Session::get('user_id');
?>

<footer class="ps-footer ps-footer--12">
    <div class="ps-footer--top">
        <div class="container">
            <div class="row m-0">
                <div class="col-12 col-sm-4 p-0">
                    <p class="text-center"><a class="ps-footer__link" href="#"><i class="icon-wallet"></i>100% Money back</a></p>
                </div>
                <div class="col-12 col-sm-4 p-0">
                    <p class="text-center"><a class="ps-footer__link" href="#"><i class="icon-bag2"></i>Non-contact shipping</a></p>
                </div>
                <div class="col-12 col-sm-4 p-0">
                    <p class="text-center"><a class="ps-footer__link" href="#"><i class="icon-truck"></i>Free delivery for order over $200</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="ps-footer__middle">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="ps-footer--address">
                                <div class="ps-logo"><a href="index.html"> <img src="{{ asset('assets/frontend/') }}/img/sticky-logo.png" alt><img class="logo-white" src="{{ asset('assets/frontend/') }}/img/logo-white.png" alt><img class="logo-black" src="{{ asset('assets/frontend/') }}/img/Logo-black.png" alt><img class="logo-white-all" src="{{ asset('assets/frontend/') }}/img/logo-white1.png" alt><img class="logo-green" src="{{ asset('assets/frontend/') }}/img/logo-green.png" alt></a></div>
                                <div class="ps-footer__title">Our store</div>
                                <p>{{$siteInfo->address}}</p>
                                <!-- <p><a target="_blank" href="#">Show on map</a></p> -->
                                <ul class="ps-social">
                                    <li><a class="ps-social__link facebook" href="{{$social_link->facebook}}"><i class="fa fa-facebook"> </i><span class="ps-tooltip">Facebook</span></a></li>
                                    <li><a class="ps-social__link instagram" href="{{$social_link->instagram}}"><i class="fa fa-instagram"></i><span class="ps-tooltip">Instagram</span></a></li>
                                    <li><a class="ps-social__link youtube" href="{{$social_link->youtube}}"><i class="fa fa-youtube-play"></i><span class="ps-tooltip">Youtube</span></a></li>
                                    <li><a class="ps-social__link pinterest" href="{{$social_link->twitter}}"><i class="fa fa-twitter"></i><span class="ps-tooltip">Twitter</span></a></li>
                                    <li><a class="ps-social__link linkedin" href="{{$social_link->linkedin}}"><i class="fa fa-linkedin"></i><span class="ps-tooltip">Linkedin</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="ps-footer--contact">
                                <h5 class="ps-footer__title">Need help</h5>
                                <div class="ps-footer__fax"><i class="icon-telephone"></i>{{$siteInfo->phone}} – {{$siteInfo->site_name}}</div>
                                <p class="ps-footer__work">Monday – Friday: 9:00-20:00<br>Saturday: 11:00 – 15:00</p>
                                <hr>
                                <p><a class="ps-footer__email" href="mailto:{{$siteInfo->email}}"> <i class="icon-envelope"></i>{{$siteInfo->email}} </a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="row">

                        @foreach($page_categories->take(2) as $page_category)
                            <?php
                                $pages = App\Models\Page::where('page_category_id', $page_category->id)->where('status', 1)->get();
                            ?>
                        <div class="col-6 col-md-4">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">{{$page_category->name}}</h5>
                                <ul class="ps-block__list">
                                    @foreach($pages as $page)
                                    <li><a href="{{route('/', [$page->slug])}}">{{$page->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-6 col-md-4">
                            <div class="ps-footer--block">
                                <h5 class="ps-block__title">Account</h5>
                                <ul class="ps-block__list">
                                    @if($user_id)
                                    <li><a href="{{route('account')}}">My account</a></li>
                                    <li><a href="{{route('account')}}">My orders</a></li>
                                    <li><a href="{{route('wishlist')}}">Wishlist</a></li>
                                    <li><a href="{{route('logout')}}">Logout</a></li>
                                    @else
                                    <li><a href="{{route('login')}}">My account</a></li>
                                    <li><a href="{{route('login')}}">My orders</a></li>
                                    <li><a href="{{route('login')}}">Wishlist</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-footer--bottom">
            <div class="row">
                <div class="col-12 col-md-6">
                    <p>Copyright © <?php echo date('Y'); ?> {{$siteInfo->site_name}}. All Rights Reserved</p>
                </div>
                <div class="col-12 col-md-6 text-right"><img src="{{ asset('assets/frontend/') }}/img/payment.png" alt><img class="payment-light" src="{{ asset('assets/frontend/') }}/img/payment-light.png" alt></div>
            </div>
        </div>
    </div>
</footer>