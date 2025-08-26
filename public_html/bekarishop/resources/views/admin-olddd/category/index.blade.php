@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Menu</title>
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
                    <h1>Category Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Menu Form</li>
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
                    <div class="card card-primary category-form">
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
                            <h3 class="card-title">Add Menu</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('category.store')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Menu Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Menu Name">
                                </div>
                                
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Parent Category</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="" selected="" disabled="">Select</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea name="description" class="form-control" rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                </div>


                                    <!-- <div class="form-group mt-5">
                                        <label for="exampleInputEmail1"><span class="text-danger">Category SEO</span></label>
                                    </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Meta Title">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Description</label>
                                    <input type="text" name="meta_des" class="form-control" id="exampleInputEmail1" placeholder="Meta Description">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" placeholder="Meta Keywords">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Image</label>
                                    <input type="file" name="meta_image" class="form-control" id="exampleInputEmail1">
                                </div> -->


                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label> Status</label>
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
                                <h3 class="card-title">Manage Menu</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <!-- <th>Parent</th> -->
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($categories as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><img src="{{ asset($item->image) }}" alt="" style=" background: #fff; width: 100px;height: 50px;text-align: center;box-sizing: border-box;box-shadow: 6px 9px 11px -5px rgba(0,0,0,0.30);object-fit: contain"></td>
                                        <td>{{$item->name}}</td>
                                        <!-- <td>

                                            @if($item->parent_id == 0)
                                                {{ 'Main Category' }}
                                            @else
                                                {{$item->parent->name ?? ''}}
                                            @endif

                                        </td> -->
                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">

                                            <button data-id="{{$item->id}}" class="btn btn-primary  btn-sm edit mx-1" >
                                                <span class="fa fa-edit"></span>
                                            </button>


                                            <form action="{{URL::to('admin/category/'.$item->id)}}" method="post">
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