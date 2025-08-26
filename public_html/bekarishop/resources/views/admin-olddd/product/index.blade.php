@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Product</title>
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
                    <h1>Manage Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <!-- <th>Buy Price</th> -->
                                        <th>Sell Price</th>
                                        <!-- <th>Discount</th>
                                        <th>Discount Price</th> -->
                                        <th>Available QTY</th>
                                        <th>Total Sell</th>
                                        <th>Total QTY</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($products as $item)
                                    
                                    <?php 
                                        
                                        $product = DB::table('product_categories')->where('product_id', $item->id)->first();
                                        $category = DB::table('categories')->where('id', $product->category_id)->first();
                                            
                                    ?>
                                    <tr>
                                        <td>{{$item->serial}}</td>
                                        <!--<td><img src="{{ asset($item->product_image_thumb) }}" alt="" style=" background: #fff; width: 100px;height: 50px;text-align: center;box-sizing: border-box;box-shadow: 6px 9px 11px -5px rgba(0,0,0,0.30);object-fit: cover"></td>-->
                                        <td> <a href="{{ asset($item->product_image_thumb) }}" target="_blank"> <button class="btn btn-primary btn-sm"> Download </button> </a> </td>
                                        <td>{{$category->name ?? ''}}</td>
                                        <td>{{$item->name}}</td>

                                        <td>
                                            {{$item->slug}}
                                        </td>   

                                        <!-- <td>{{$item->buying_price}}</td> -->
                                        <td>{{$item->sell_price}}</td>
                                        <!-- <td>{{$item->discount ?? ''}}</td>
                                        <td>{{$item->discount_price ?? ''}}</td> -->
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->total_sell}}</td>
                                        <td>{{$item->total_product}}</td>

                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">

                                            <a href="{{URL::to('admin/product/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a>

                                            <form action="{{URL::to('admin/product/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </table>
                                
                                {{ $products->links() }}
                                
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