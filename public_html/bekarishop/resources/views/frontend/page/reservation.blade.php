@extends('frontend.layouts.app')


@section('head')
    <title> Blog - {{ $site_seo->meta_title }}</title>
@endsection


@section('content')

    <main>

    <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->reserv_banner_home_image ?? '') }})">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>Book Our Resturant</h1>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <!-- /hero_single -->

    <div class="pattern_2">
        <div class="container margin_120_100 pb-0">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center d-none d-lg-block" data-cue="slideInUp">
                    <img src="{{ asset($site_image->reserv_profile_home_image ?? '') }}" width="400" height="733" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-8" data-cue="slideInUp">
                    <div class="main_title">
                        <span><em></em></span>
                        <h2>    বিয়ে, জন্মদিন, গায়ে হলুদ ও বৌ ভাত সহ যেকোন অনুষ্ঠানের জন্য বুকিং দিন।       </h2>
                        <p>যোগাযোগ করুন - {{$site_info->phone}}</p>
                    </div>
                    <div id="wizard_container">

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
                        
                        <form action="{{route('submit-booking')}}" id="wrapped" method="POST">
                            @csrf
                            <input id="website" name="website" type="text" value="">
                            <!-- Leave for security protection, read docs for details -->
                            <div id="middle-wizard">
                                <div class="step">
                                    <h3 class="main_question"><strong>1/3</strong> Please Select a date</h3>
                                    <div class="form-group">
                                        <input type="hidden" name="booking_date" id="datepicker_field" class="required">
                                    </div>
                                    <div id="DatePicker"></div>
                                </div>
                                <!-- /step-->
                                <div class="step">
                                    <h3 class="main_question"><strong>2/3</strong> Select time, duration and guests</h3>

                                    <div class="step_wrapper">
                                        <h4>Start time - End Time</h4>
                                        <div class="radio_select add_bottom_15">
                                            <ul>
                                                <li>
                                                    <input type="time" id="time_1" name="start_time"class="required form-control">
                                                </li>
                                                
                                                <li>
                                                    <input type="time" id="time_6" name="end_time" class="required form-control">
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        <!-- /time_select -->
                                    </div>
                                    <!-- /step_wrapper -->
                                    <div class="step_wrapper">
                                        <h4>Durantion</h4>
                                        <div class="radio_select">
                                            <ul>
                                                <li class="w-100">
                                                    <select name="duration" class="form-control required" id="" required="">
                                                        <option value="">Select</option>
                                                        <option value="1">1 Day</option>
                                                        <option value="2">2 Days</option>
                                                        <option value="3">3 Days</option>
                                                        <option value="4">4 Days</option>
                                                        <option value="5">5 Days</option>
                                                        <option value="6">6 Days</option>
                                                        <option value="7">7 Days</option>
                                                        <option value="8">8 Days</option>
                                                        <option value="9">9 Days</option>
                                                        <option value="10">10 Days</option>
                                                    </select>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /people_select -->
                                    </div>
                                    <!-- /step_wrapper -->
                                    <div class="step_wrapper">
                                        <h4>How many people?</h4>
                                        <div class="radio_select">
                                            <ul>
                                                <li class="w-100">
                                                    <input type="number" id="people_1" name="people"  class="required form-control" required="">
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /people_select -->
                                    </div>
                                    <!-- /step_wrapper -->
                                </div>
                                <!-- /step-->
                                <div class="submit step">
                                    <h3 class="main_question"><strong>3/3</strong> Please fill with your details</h3>
                                    <div class="form-group">
                                        <input type="text" name="full_name" class="form-control required" placeholder="First and Last Name">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control required" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="telephone" class="form-control required" placeholder="Your Telephone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control required" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="opt_message" placeholder="Please provide any additional info"></textarea>
                                    </div>
                                    <div class="form-group terms">
                                        <label class="container_check">Please accept our <a href="#" data-toggle="modal" data-target="#terms-txt">Terms and conditions</a>
                                            <input type="checkbox" name="terms" value="Yes" class="required">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <!-- /step-->
                            </div>
                            <!-- /middle-wizard -->
                            <div id="bottom-wizard">
                                <button type="button" name="backward" class="backward">Prev</button>
                                <button type="button" name="forward" class="forward">Next</button>
                                <button type="submit" name="process" class="submit">Submit</button>
                            </div>
                            <!-- /bottom-wizard -->
                        </form>
                    </div>
                    <!-- /Wizard container -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /pattern_2 -->

    </main>


@stop
