@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Setting Section</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Site Settings</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
<!-- Main content -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Logo</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Favicon</a></li>
                <li class="nav-item"><a class="nav-link" href="#siteInfo" data-toggle="tab">Site Info</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="#socialLink" data-toggle="tab">Socail Link</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link" href="#seo" data-toggle="tab">SEO Setting</a></li> --}}
                {{-- <li class="nav-item"><a class="nav-link" href="#imageSetting" data-toggle="tab">Image Setting</a></li> --}}
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <!-- Post -->
                  <form class="form-horizontal" action="{{route('save-logo')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      
                      
                      
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Logo ( White )</label>
                      <div class="col-sm-6">
                          <img src="{{ asset($imge->logo ?? '') }}" style="width: 180px;background: black;padding: 9px;margin-bottom: 5px" />
                    
                        <input type="file" name="logo" class="form-control">
                        <input type="hidden" value="{{$imge->id ?? ''}}" name="img_id" class="form-control" id="inputName">
                      </div>
                    </div>
                    
                    
                      
                      
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Logo ( Black )</label>
                      <div class="col-sm-6">
                          <img src="{{ asset($imge->logo_black ?? '') }}" style="width: 180px;padding: 9px;border: 1px solid;margin-bottom: 5px" />
                   
                        <input type="file" name="logo_black" class="form-control">
                        <input type="hidden" value="{{$imge->id ?? ''}}" name="img_id" class="form-control" id="inputName">
                      </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>

                  <!-- /.post -->
                </div>
                <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-favicon')}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Favicon</label>
                        <div class="col-sm-6">
                            <img src="{{ asset($imge->favicon ?? '') }}" style="height: 100px; width: 100px;" />
                          <input type="file" name="fav_icon" class="form-control" id="inputName">
                            <input type="hidden" value="{{$imge->id ?? ''}}" name="fav_id" class="form-control" id="inputName">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="tab-pane" id="siteInfo">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-site-info', [$site_info->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">

                        <div class="col-sm-4">
                          <label for="inputName" class="col-form-label">Site Name</label>
                            <input type="text" name="site_name" class="form-control" id="inputName" value="{{$site_info->site_name  ?? ''}}">
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Site Phone</label>
                            <input type="text" name="phone" class="form-control" id="inputName" value="{{$site_info->phone  ?? ''}}">
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Site Owner Number ( For get order notification through SMS )</label>
                            <input type="text" name="site_owner_number" class="form-control" id="inputName" value="{{$site_info->site_owner_number  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputName" value="{{$site_info->email  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="inputName" value="{{$site_info->address  ?? ''}}">
                        </div>

                        {{-- <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Shipping Charge</label>
                            <input type="number" name="shipping_charge" class="form-control" id="inputName" value="{{$site_info->shipping_charge  ?? ''}}">
                        </div>


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Tax</label>
                            <input type="number" name="tax" class="form-control" id="inputName" value="{{$site_info->tax  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Opening Hours</label>
                            <input type="text" name="opening_hours" class="form-control" id="inputName" value="{{$site_info->opening_hours  ?? ''}}">
                        </div> --}}

                        {{-- <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Close</label>
                            <input type="text" name="resturant_close" class="form-control" id="inputName" value="{{$site_info->resturant_close  ?? ''}}">
                        </div>

                        <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">Location API</label>
                            <textarea name="location_api" id="" cols="30" rows="5" class="form-control">{{$site_info->location_api  ?? ''}}</textarea>
                        </div>


                        <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">Footer Description</label>
                            <input type="text" name="footer_description" class="form-control" id="inputName" value="{{$site_info->footer_description  ?? ''}}">
                        </div>


                        <div class="col-sm-12">
                            <label for="inputName" class="col-form-label">Catering Title</label>
                            <input type="text" name="catering_title" class="form-control" id="inputName" value="{!! $site_info->catering_title  ?? '' !!}">
                        </div> --}}


                        {{-- <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Subscribe Title</label>
                            <input type="text" name="subscribe_title" class="form-control" id="inputName" value="{{$site_info->subscribe_title  ?? ''}}">
                        </div>


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Subscription Image</label>
                            <br>
                            @if(isset($site_info))
                                <img src="{{ asset($site_info->subscribe_image) }}" alt="{{$site_info->meta_title}}" style="width: 40%; margin-top: 8px;margin-bottom: 8px">
                                <input type="hidden" name="old_subscribe_image" value="{{ $site_info->subscribe_image }}">
                            @endif
                            <input type="file" name="subscribe_image" class="form-control" id="exampleInputEmail1">
                        </div> --}}





                        {{-- <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Welcome To Govindas Restaurant Image</label>
                            <br>
                            @if(isset($site_info))
                                <img src="{{ asset($site_info->welcome_resturant_image) }}" alt="{{$site_info->meta_title}}" style="width: 40%; margin-top: 8px;margin-bottom: 8px">
                                <input type="hidden" name="old_welcome_resturant_image" value="{{ $site_info->welcome_resturant_image }}">
                            @endif
                            <input type="file" name="welcome_resturant_image" class="form-control" id="exampleInputEmail1">
                        </div>


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Welcome To Govindas Restaurant Description</label>
                            <textarea name="welcome_resturant_description" id="" cols="30" rows="10" class="form-control">{!! $site_info->welcome_resturant_description  ?? '' !!}</textarea>
                        </div> --}}



    
{{-- 
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label"> <span class="text-danger">Google Analytics Code</span> </label>
                            <textarea name="google_anlytics_code" class="form-control" id="" cols="30" rows="10">{!!$site_info->google_anlytics_code!!}</textarea>
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label"> <span class="text-danger">Robots.txt</span></label>
                            <textarea name="robots_txt" class="form-control" id="" cols="30" rows="10">{!!$site_info->robots_txt!!}</textarea>
                        </div> --}}

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

                <div class="tab-pane" id="socialLink">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-social-link', [$site_info->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" id="inputName" value="{{$social_link->facebook  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control" id="inputName" value="{{$social_link->twitter  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" id="inputName" value="{{$social_link->linkedin  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control" id="inputName" value="{{$social_link->instagram  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Youtube</label>
                            <input type="text" name="youtube" class="form-control" id="inputName" value="{{$social_link->youtube  ?? ''}}">
                        </div>

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

                <div class="tab-pane" id="seo">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-seo', [$site_info->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">


                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" id="inputName"  value="{{$seo->meta_title  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Description</label>
                            <input type="text" name="meta_des" class="form-control" id="inputName"  value="{{$seo->meta_des  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" id="inputName"  value="{{$seo->meta_keywords  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Robots</label>
                            <input type="text" name="robots" class="form-control" id="inputName"  value="{{$seo->robots  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Canonical ( Link )</label>
                            <input type="text" name="canonical" class="form-control" id="inputName"  value="{{$seo->canonical  ?? ''}}">
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Meta Image</label>
                            <input type="file" name="meta_image" class="form-control" id="inputName">
                            @if(isset($seo))
                            <div class="form-group">
                                <img src="{{ asset($seo->meta_image) }}" alt="meta_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_meta_image" value="{{ $seo->meta_image }}">
                            </div>
                            @endif
                        </div>

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

                <div class="tab-pane" id="imageSetting">
                    <!-- The timeline -->
  
                      <form class="form-horizontal" action="{{route('save-image', [$site_image->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                      <div class="form-group row">


                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Our menu ( Home Page )</label>
                            <input type="file" name="menu_home_image" class="form-control" id="inputName">
                            <span><strong>Size- 501 × 334 px</strong></span>

                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->menu_home_image) }}" alt="menu_home_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_menu_home_image" value="{{ $site_image->menu_home_image }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Reservations ( Home Page )</label>
                            <input type="file" name="reserv_home_image" class="form-control" id="inputName">
                            <span><strong>Size- 501 × 334 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->reserv_home_image) }}" alt="reserv_home_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_reserv_home_image" value="{{ $site_image->reserv_home_image }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Gallery ( Home Page )</label>
                            <input type="file" name="gallery_home_image" class="form-control" id="inputName">
                            <span><strong>Size- 501 × 334 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->gallery_home_image) }}" alt="gallery_home_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_gallery_home_image" value="{{ $site_image->gallery_home_image }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Reservations Banner ( Home Page )</label>
                            <input type="file" name="reserv_banner_home_image" class="form-control" id="inputName">
                            <span><strong>Size- 1200 × 600 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->reserv_banner_home_image) }}" alt="reserv_banner_home_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_reserv_banner_home_image" value="{{ $site_image->reserv_banner_home_image }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Contact Banner ( Home Page )</label>
                            <input type="file" name="contact_banner_home_image" class="form-control" id="inputName">
                            <span><strong>Size- 1600 × 1067 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->contact_banner_home_image) }}" alt="contact_banner_home_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_contact_banner_home_image" value="{{ $site_image->contact_banner_home_image }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-4">
                            <label for="inputName" class="col-form-label">Reservations profile ( Home Page )</label>
                            <input type="file" name="reserv_profile_home_image" class="form-control" id="inputName">
                            <span><strong>Size- 420 × 770 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->reserv_profile_home_image) }}" alt="reserv_profile_home_image" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_reserv_profile_home_image" value="{{ $site_image->reserv_profile_home_image }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Menu Banner ( Menu Page )</label>
                            <input type="file" name="menu_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->menu_banner) }}" alt="menu_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_menu_banner" value="{{ $site_image->menu_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Shop Banner ( Shop Page )</label>
                            <input type="file" name="shop_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->shop_banner) }}" alt="shop_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_shop_banner" value="{{ $site_image->shop_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Gallery Banner ( Gallery Page )</label>
                            <input type="file" name="gallery_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->gallery_banner) }}" alt="gallery_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_gallery_banner" value="{{ $site_image->gallery_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Facility Banner ( Facility Page )</label>
                            <input type="file" name="facility_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->facility_banner) }}" alt="facility_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_facility_banner" value="{{ $site_image->facility_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Blog Banner ( Blog Page )</label>
                            <input type="file" name="blog_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->blog_banner) }}" alt="blog_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_blog_banner" value="{{ $site_image->blog_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Contact Banner ( Contact Page )</label>
                            <input type="file" name="contact_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->contact_banner) }}" alt="contact_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_contact_banner" value="{{ $site_image->contact_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">My Account Banner ( My Account Page )</label>
                            <input type="file" name="my_account_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->my_account_banner) }}" alt="my_account_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_my_account_banner" value="{{ $site_image->my_account_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Login Banner ( Login Page )</label>
                            <input type="file" name="login_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->login_banner) }}" alt="login_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_login_banner" value="{{ $site_image->login_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Registration Banner ( Registration Page )</label>
                            <input type="file" name="registration_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->registration_banner) }}" alt="registration_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_registration_banner" value="{{ $site_image->registration_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Cart Banner ( Cart Page )</label>
                            <input type="file" name="cart_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->cart_banner) }}" alt="cart_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_cart_banner" value="{{ $site_image->cart_banner }}">
                            </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="inputName" class="col-form-label">Checkout Banner ( Checkout Page )</label>
                            <input type="file" name="checkout_banner" class="form-control" id="inputName">
                            <span><strong>Size- 1400 × 788 px</strong></span>
                            
                            @if(isset($site_image))
                            <div class="form-group">
                                <img src="{{ asset($site_image->checkout_banner) }}" alt="checkout_banner" style="width: 20%; margin-top: 8px">
                                <input type="hidden" name="old_checkout_banner" value="{{ $site_image->checkout_banner }}">
                            </div>
                            @endif
                        </div>

                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>

              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('script')
<script src="{{asset('admin/asset')}}/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.add', function(){
            var html = '';
            html += '<tr>';
            html += '<td><input type="file" name="image[]" class="form-control" required/></td>';
            html += '<td><input type="text" name="link[]" class="form-control" placeholder="link"/></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus-circle"></span></button></td></tr>';
            $('#productImage').append(html);
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
        });


        token = $( "input[value='_token']" ).val();
        $('#title').on('keyup',function(){
        data = {
            "_token": token,
            "str": $(this).val()
        };

    });
});
</script>
@endsection
