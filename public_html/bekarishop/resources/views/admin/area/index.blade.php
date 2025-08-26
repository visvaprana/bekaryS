@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Area</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Area Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Area Form</li>
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
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary area-form">
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
                            <h3 class="card-title">Add Area</h3>
                            
                            <a href="{{route('admin/import-area')}}"><button class="btn btn-info float-sm-right">Import Area</button></a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('area.store')}}" method="post">
                            @csrf
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country<span style="color: red">*</span></label>
                                    
                                    <select name="country_id" id="country_id" class="form-control" required="" onchange="GetCity(this.value)">
                                        <option value="" disabled="" selected="">Select</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">City<span style="color: red">*</span></label>
                                    
                                    <select name="city_id" id="city_id" class="form-control" required="">
                                        <option value="" disabled="" selected="">Select</option>
                                        <!-- @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach -->
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Area Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Area Name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Postcode</label>
                                    <input type="text" name="postcode" class="form-control" id="exampleInputEmail1" placeholder="Postcode" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Shipping Charge</label>
                                    <input type="number" name="shipping_charge" class="form-control" id="exampleInputEmail1" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Urgent Charge</label>
                                    <input type="number" name="urgent_charge" class="form-control" id="exampleInputEmail1" required="">
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
                <!-- right column -->
                <div class="col-md-8">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Area</h3>
                                <a href="{{route('admin/delete-all-area')}}" class=""><button class="btn btn-danger float-sm-right">Delete All Area</button></a>
                                <a href="{{route('admin/import-area')}}"><button class="btn btn-info float-sm-right  mr-2">Import Area</button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <!-- <th>Country</th> -->
                                        <th>City</th>
                                        <th>Area Name</th>
                                        <th>Postcode</th>
                                        <th>Shipping Charge</th>
                                        <th>Urgent Charge</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($areas as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <!-- <td>{{$item->country->name ?? ''}}</td> -->
                                        <td>{{$item->city->name ?? ''}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->postcode}}</td>
                                        <td>{{$item->shipping_charge}}</td>
                                        <td>{{$item->urgent_charge}}</td>
                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">
                                            
                                            <button data-id="{{$item->id}}" class="btn btn-primary edit btn-sm mx-1" >
                                                <span class="fa fa-edit"></span>
                                            </button>

                                            <form action="{{URL::to('admin/area/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
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