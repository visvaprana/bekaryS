<?php
    $siteInfo = App\Models\Siteinfo::first();
    $user_id = Session::get('user_id');
    $social_link = App\Models\SiteSocialLink::first();
    $marquees = App\Models\Marquee::where('status', 1)->get();
?>


        
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> {{$siteInfo->phone}}</strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    @foreach($marquees as $marquee)
                                    <li>{{$marquee->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                
                                <li class="mobile-social-icon">

                                    <a href="{{$social_link->facebook}}" target="_blank"><img src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-facebook-white.svg" alt="{{$social_link->name}}"></a>

                                    <a href="{{$social_link->twitter}}" target="_blank"><img src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-twitter-white.svg" alt="{{$social_link->name}}"></a>

                                    <a href="{{$social_link->instagram}}" target="_blank"><img src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-instagram-white.svg" alt="{{$social_link->name}}"></a>
                        
                                    <a href="{{$social_link->youtube}}" target="_blank"><img src="{{ asset('assets/frontend/') }}/assets/imgs/theme/icons/icon-youtube-white.svg" alt="{{$social_link->name}}"></a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>