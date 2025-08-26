@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Edit </title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')

<?php
    $user_id = Session::get('adminId');
    $user = App\Models\Admin::where('id', $user_id)->first();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resturant Edit Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Resturant Edit Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Edit Resturant</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{URL::to('admin/resturant/'.$data->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                            	<div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Resturant Name</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Resturant Name" value="{{$data->name}}">
                                        </div> 
                                    </div>

                                    @if($user->role_id == 1)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount( % - Optional)</label>
                                            <input type="number" name="discount" class="form-control" id="exampleInputEmail1" value="{{$data->discount}}">
                                        </div> 
                                    </div>
                                    @endif


	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Country<span style="color: red">*</span></label>
		                                    
		                                    <select name="country_id" id="country_id" class="form-control" required="" onchange="GetCity(this.value)">
		                                        <option value="" disabled="" selected="">Select</option>
		                                        @foreach($countries as $country)
		                                        <option value="{{$country->id}}"  @php echo $data->country_id==$country->id?"selected":""; @endphp>{{$country->name}}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>

	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">City<span style="color: red">*</span></label>
		                                    
		                                    <select name="city_id" id="city_id" class="form-control" required="" onchange="GetArea(this.value)">
		                                        <option value="" disabled="" selected="">Select</option>
		                                        @foreach($cities as $city)
		                                        <option value="{{$city->id}}"  @php echo $data->city_id==$city->id?"selected":""; @endphp>{{$city->name}}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>

	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Area<span style="color: red">*</span></label>
		                                    
		                                    <select name="area_id" id="area_id" class="form-control" required="">
		                                        <option value="" disabled="" selected="">Select</option>
		                                        @foreach($areas as $area)
		                                        <option value="{{$area->id}}"  @php echo $data->area_id==$area->id?"selected":""; @endphp>{{$area->name}}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>





                            	</div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Address"  value="{{$data->address}}">
                                </div>


                                <div class="row">
                                	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Opening Time</label>
		                                    <input type="text" name="opening_time" class="form-control" id="exampleInputEmail1" placeholder="11:00 AM - 10:00 PM"  value="{{$data->opening_time}}">
		                                </div>
                                	</div>
                                	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Delivery hours</label>
		                                    <input type="text" name="delivery_hours" class="form-control" id="exampleInputEmail1" placeholder="Mon - Sun 11:00 AM - 10:00 PM"  value="{{$data->delivery_hours}}">
		                                </div>
                                	</div>
                                	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Resturant Open/Close?</label>
                                            <select class="custom-select" name="open_closed">
                                                <option value="open"  @php echo $data->open_closed=='open'?"selected":""; @endphp>Open</option>
                                                <option value="closed"  @php echo $data->open_closed=='closed'?"selected":""; @endphp>Closed</option>
                                            </select>
		                                </div>
                                	</div>

                                	<div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Logo</label>

                                            @if(isset($data))
                                            <div class="form-group">
                                                <img src="{{ asset($data->image) }}" alt="Image" style="width: 20%; margin-top: 8px">
                                                <input type="hidden" name="old_image" value="{{ $data->image }}">
                                            </div>
                                            @endif

		                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
		                                </div>
                                	</div>

                                	<div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Cover Image</label>

                                            @if(isset($data))
                                            <div class="form-group">
                                                <img src="{{ asset($data->cover_image) }}" alt="Image" style="width: 20%; margin-top: 8px">
                                                <input type="hidden" name="old_cover_image" value="{{ $data->cover_image }}">
                                            </div>
                                            @endif

		                                    <input type="file" name="cover_image" class="form-control" id="exampleInputEmail1">
		                                </div>
                                	</div>



                                    <div class="form-group mt-5">
                                        <label for="exampleInputEmail1"><span class="text-danger">Resturant SEO</span></label>
                                    </div>

                                    <div class="col-md-12"></div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Meta Title" value="{{$data->meta_title}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                            <input type="text" name="meta_des" class="form-control" id="exampleInputEmail1" placeholder="Meta Description" value="{{$data->meta_des}}">
                                        </div>   
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" placeholder="Meta Keywords" value="{{$data->meta_keywords}}">
                                        </div>
                                    </div>

                                </div>







                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Publication Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1" @php if ($data['status'] == 1) { echo "selected"; } @endphp>Active</option>
                                                <option value="0" @php if ($data['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@section('script')
    @include('admin.layouts.js_script_backend')
@endsection