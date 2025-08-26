@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    $social_link = App\Models\SiteSocialLink::first();
    $siteInfo = App\Models\Siteinfo::first();
    ?>
    <title> Contact - {{ $site_seo->meta_title }}</title>
@endsection
@section('content')



    <main>

        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->contact_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Contact Us</h1>
                            <!-- <p>Per consequat adolescens ex cu nibh commune</p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->

        <!--<div class="bg_gray">-->
        <!--    <div class="container margin_60_40">-->
        <!--        <div class="row justify-content-center">-->
        <!--            <div class="col-lg-4">-->
                        <!--<div class="box_contacts">-->
                        <!--    <i class="icon_tag_alt"></i>-->
                        <!--    <h2>Reservations</h2>-->
                        <!--    <a href="#0">{{$siteInfo->phone}}</a> - <a href="#0">{{$siteInfo->email}}</a>-->
                        <!--    <small>- <a href="{{route('reservation')}}">Or use the contact form</a> -</small>-->
                        <!--</div>-->
        <!--            </div>-->
        <!--            <div class="col-lg-4">-->
        <!--                <div class="box_contacts">-->
        <!--                    <i class="icon_pin_alt"></i>-->
        <!--                    <h2>Address</h2>-->
        <!--                    <div>{{$siteInfo->address}}</div>-->
                            <!-- <small>- <a href="#0">Get Directions</a> -</small> -->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-lg-4">-->
                        <!--<div class="box_contacts">-->
                        <!--    <i class="icon_clock_alt"></i>-->
                        <!--    <h2>Opening Hours</h2>-->
                        <!--    <div>{{$siteInfo->opening_hours ?? ''}}</div>-->
                        <!--    <small>{{$siteInfo->resturant_close ?? ''}}</small>-->
                        <!--</div>-->
        <!--            </div>-->
        <!--        </div>-->
                <!-- /row -->
        <!--    </div>-->
            <!-- /container -->
        <!--</div>-->
        <!-- /bg_gray -->
        
        
        
        <!-- start:: contact body -->
<section class="contact-body-section">
<div class="container margin_60_40">
            <h5 class="text-center pb-5 contact-title text-uppercase">Contact With Us</h5>
            <div class="row g-4">
                <div class="col-md-6 add_bottom_25">
                    <div class="contact-box-wrapper">
                    <div id="message-contact"></div>
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
                </div>
                <div class="col-md-6 add_bottom_25">
                    <div class="contact-box-wrapper">
                      <!-- <iframe class="map_contact" src="{{$siteInfo->location_api ?? ''}}" allowfullscreen></iframe> -->

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.9415204690517!2d90.42077021496725!3d23.71378229609106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9b2be5da11b%3A0x87cdf72b70e6fe7f!2sISKCON%20Govinda&#39;s!5e0!3m2!1sen!2sbd!4v1672121711360!5m2!1sen!2sbd" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div> <!-- /row -->
        </div>
</section>
<!-- start:: contact body -->
        
        
        
        
        

        <!--<div class="container margin_60_40">-->
        <!--    <h5 class="mb_5">Drop Us a Line</h5>-->
        <!--    <div class="row">-->
        <!--        <div class="col-lg-4 col-md-6 add_bottom_25">-->
        <!--            <div id="message-contact"></div>-->
        <!--            @if ($errors->any())-->
        <!--                <div class="alert alert-danger">-->
        <!--                    <ol>-->
        <!--                        @foreach ($errors->all() as $error)-->
        <!--                            <li style="font-size: 12px">{{ $error }}</li>-->
        <!--                        @endforeach-->
        <!--                    </ol>-->
        <!--                </div>-->
        <!--            @endif-->

        <!--            @if (session()->has('notif'))-->
        <!--                <div class="alert alert-success">-->
        <!--                    <strong style="font-size: 12px">{{ session()->get('notif') }}</strong>-->
        <!--                </div>-->
        <!--            @endif-->

        <!--            <form method="post" action="{{route('send-message')}}" id="contactform" autocomplete="off">-->
        <!--                @csrf-->
        <!--                <div class="form-group">-->
        <!--                    <input class="form-control" type="text" placeholder="Name" id="name_contact" name="name" required="">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <input class="form-control" type="email" placeholder="Email" id="email_contact" name="email" required="">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <input class="form-control" type="text" placeholder="Phone Number" name="phone" required="">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <input class="form-control" type="text" placeholder="Subject" name="subject" required="">-->
        <!--                </div>-->
        <!--                <div class="form-group">-->
        <!--                    <textarea class="form-control" style="height: 100px;" placeholder="Message" id="message_contact" name="message" required=""></textarea>-->
        <!--                </div>-->
                        
        <!--                <div class="form-group">-->
        <!--                    <input class="btn_1 full-width" type="submit" value="Submit" id="submit-contact">-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <!--        <div class="col-lg-8 col-md-6 add_bottom_25">-->
        <!--            <iframe class="map_contact" src="{{$siteInfo->location_api ?? ''}}" allowfullscreen></iframe>-->
        <!--        </div>-->
        <!--    </div>-->
            <!-- /row -->
        <!--</div>-->
        <!-- /container -->
        
    </main>




@stop
