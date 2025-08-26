@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title> Register- {{ $site_seo->meta_title }}</title>
@endsection
@section('content')



    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->registration_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Register</h1>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->

         <!-- /filters_full -->

        <div class="page-content pt-150 pb-150 margin_60_40">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="tab-content account dashboard-content pl-50">

                            <div class="tab-pane login">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h3 class="mb-0 ">Sign Up</h3>
                                    </div>
                                    <div class="card-body contact-from-area">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-center pb-3">Already have an account? <a href="{{route('login')}}">sign in instead!</a></p>

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

                                                <form class="contact-form-style mt-30 mb-50" action="{{route('registration')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="text" required="" name="fname" placeholder="First Name" value="{{old('fname')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" required="" name="lname" placeholder="Last Name"  value="{{old('lname')}}">
                                                    </div>
                                                    <!--<div class="form-group">-->
                                                    <!--    <input type="text" required="" name="email" placeholder="Email"  value="{{old('email')}}">-->
                                                    <!--</div>-->
                                                    <div class="form-group">
                                                        <input type="text" required="" name="phone" placeholder="Phone Number"  value="{{old('phone')}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input required="" type="password" name="password" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input required="" type="password" name="password_confirmation" placeholder="Password Confirmation">
                                                    </div>
                                                    <button class="submit submit-auto-width" type="submit">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>


        <!-- /filters -->




        <div class="container margin_60_40">


            <!-- /row -->
        </div>
        <!-- /container -->

    </main>


@stop