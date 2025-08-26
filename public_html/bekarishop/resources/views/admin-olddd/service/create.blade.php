@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Create </title>
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
                    <h1>Service Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Service Form</li>
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
                            <h3 class="card-title">Add Service</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                            	<div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder=" Title" >
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Start Price <span style="color: red">(USD: $ )</span> </label>
                                            <input type="number" name="start_price" class="form-control" value="{{ old('start_price') }}" placeholder="00.00">
                                        </div> 
                                    </div> -->

                            	</div>


                                <div class="row">

                                	

                                	<div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Icon ( Optional ) <span style="color: red">FlatiIcon Only ( website: <a href="https://www.flaticon.com/">Clicl Here For Icon</a> )</span> </label>
		                                    <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="icon flaticon-computer">
		                                </div>
                                	</div>

                                	<div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Short Description ( Optional )</label>
                                            <textarea name="short_description" class="form-control" rows="5">{{ old('short_description') }}</textarea>
		                                </div>
                                	</div>

                                	<div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Description ( Optional )</label>
                                            <textarea name="description" class="form-control textarea" id="" rows="5">{{ old('description') }}</textarea>
		                                </div>
                                	</div>


                                    <div class="form-group mt-5">
                                        <label for="exampleInputEmail1"><span class="text-danger">Service SEO</span></label>
                                    </div>
                                    <div class="col-md-12"></div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Title ( Optional )</label>
                                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title')}}" placeholder="Meta Title">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description ( Optional )</label>
                                            <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}" placeholder="Meta Description">                                        </div>   
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Keywords ( Optional )</label>
                                            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="Meta Keywords">
                                        </div>
                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Publication Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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