@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Item Package</title>
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
                    <h1>Item Package Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Item Package Form</li>
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
                    <div class="card card-primary item_package-form">
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
                            <h3 class="card-title">Add Item Package & Price</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('item_package.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Resturant<span style="color: red">*</span></label>
                                    <select name="resturant_id" id="resturant_id" class="form-control" required=""  onchange="GetResturantItem(this.value)">
                                        <option value="" selected="" disabled="">Select</option>
                                        @foreach($resturants as $resturant)
                                        <option value="{{$resturant->id}}">{{$resturant->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Item<span style="color: red">*</span></label>
                                    <select name="item_id" id="item_id" class="form-control" required="">
                                        <option value="" selected="" disabled="">Select</option>
                                        <!-- @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Package Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Package Price</label>
                                    <input type="number" name="price" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Package Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
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
                                <h3 class="card-title">Manage Item</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Package Image</th>
                                        <th>Resturant</th>
                                        <th>Item</th>
                                        <th>Package Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($item_packages as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><img src="{{ asset($item->image) }}" alt="" style=" background: #fff; width: 100px;height: 50px;text-align: center;box-sizing: border-box;box-shadow: 6px 9px 11px -5px rgba(0,0,0,0.30);object-fit: cover"></td>
                                        <td>{{$item->resturant->name ?? ''}}</td>
                                        <td>{{$item->item->name ?? ''}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">
                                            <button data-id="{{$item->id}}" class="btn btn-primary edit  btn-sm  mx-1" >
                                                <span class="fa fa-edit"></span>
                                            </button>

                                            <form action="{{URL::to('admin/item_package/'.$item->id)}}" method="post">
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