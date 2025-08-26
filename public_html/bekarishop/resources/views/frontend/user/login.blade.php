@extends('frontend.layouts.app')
@section('head')
    <?php
    $site_seo = App\Models\SiteSeo::first();
    ?>
    <title> Login- {{ $site_seo->meta_title }}</title>
@endsection
@section('content')



    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset($site_image->login_banner ?? '') }}">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>Login</h1>
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
                        <div class="tab-content account dashboard-content login-wrapper pl-50">

                            <div class="tab-pane login">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0 text-center text-bold">Sign in</h3>
                                    </div>
                                    <div class="card-body contact-from-area">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="text-center pb-3">New user ? <a href="{{route('register')}}">Comfirm Sign up!</a></p>
                                                
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
                                                
                                                <form class="contact-form-style mt-30 mb-50" action="{{route('login')}}" method="post">
                                                    @csrf
                                                    <div class="input-style mb-20 w-100">
                                                        <label>Phone Number</label>
                                                        <input name="phone" class="w-100" placeholder="Your Phone Number" type="text" required="">
                                                    </div>
                                                    <div class="input-style mb-20">
                                                        <label>Password</label>
                                                        <input name="password" placeholder="Password" type="password" required="">
                                                    </div>
                                                    <div class="text-right mt-4">
                                                        <a href="{{ route('forgot-password') }}"><h6 class="d-inline-block">Forget password</h6></a>  
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