@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Create </title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')

<style>
    
    span.select2-selection.select2-selection--single {
        height: 40px;
    }

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Form</li>
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
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                            	<div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Serial</label>
                                            <input type="number" name="serial" class="form-control" id="exampleInputEmail1" required="">
                                        </div> 
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Item Title</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Item Name" required="">
                                        </div> 
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Slug</label>
                                            <input type="text" name="slug" class="form-control" id="examplerequired="">
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code</label>
                                            <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Product Code" >
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product SKU</label>
                                            <input type="text" name="sku" class="form-control" id="exampleInputEmail1" placeholder="Product SKU" >
                                        </div> 
                                    </div> -->




	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Menu<span style="color: red">*</span></label>
                                            <br>
		                                    
		                                    <select name="category_id[]" id="category_id" class="form-control productCategory"  required="">
                                                <option value="">Select</option>
		                                        @foreach($categories as $category)
		                                        <option value="{{$category->id}}">{{$category->name}}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>

	                            	<!-- <div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Brand<span style="color: red">*</span></label>
		                                    <select name="brand_id[]" id="brand_id" class="form-control brand_id" required="" multiple="multiple">
		                                        @foreach($brands as $brand)
		                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div> -->


                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Color<span style="color: red">*</span></label>
                                            <select name="color_id[]" id="color_id" class="form-control color_id"  multiple="multiple">
                                                @foreach($colors as $color)
                                                <option value="{{$color->id}}">{{$color->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Size<span style="color: red">*</span></label>
                                            <select name="size_id[]" id="size_id" class="form-control size_id"  multiple="multiple">
                                                @foreach($sizes as $size)
                                                <option value="{{$size->id}}">{{$size->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Unit<span style="color: red">*</span></label>
                                            <select name="unit_id[]" id="unit_id" class="form-control unit_id">
                                                @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Buying Price</label>
                                            <input type="number" step=".01" name="buying_price" class="form-control" id="exampleInputEmail1" required="" value="0" readonly="">
                                        </div>
                                    </div> -->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Selling Price</label>
                                            <input type="number" step=".01" name="sell_price" class="form-control " id="sell_price" required="" >
                                        </div>
                                    </div>
{{-- 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount ( % )</label>
                                            <input type="number" name="discount" class="form-control" id="discount">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">Calculate ( = )</label> <br>
                                        <button type="button" class="btn btn-info w-100" onclick="calculateDiscount()"> = </button>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount Price</label>
                                            <input type="number" step=".01" name="discount_price" class="form-control" id="discount_price" readonly="">
                                        </div>
                                    </div> --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product QTY</label>
                                            <input type="number" name="qty" class="form-control" id="exampleInputEmail1" value="1" required="">
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-4">
                                        <label for="inputEmail3" class=" col-form-label">Min Order Qty</label>
                                        <input type="number" class="form-control" name="min_order_qty">
                                    </div>  
                                    
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class=" col-form-label">Max Order Qty</label>
                                        <input type="number" class="form-control" name="max_order_qty">
                                    </div>  -->
                                    
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class=" col-form-label">Fetaure Image</label>
                                        <input type="file" class="form-control" name="image" required="">
                                    </div> 
                                    
                                    <!--<div class="col-sm-4">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Fetaure Image Alt</label>-->
                                    <!--    <input type="text" class="form-control" name="image_alt" placeholder="Fetaure Image Alt">-->
                                    <!--</div>-->

                                    <!--<div class="col-sm-4">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Fetaure Image Description</label>-->
                                    <!--    <textarea name="image_des" class="form-control" cols="30" rows="2"></textarea>-->
                                    <!--</div>-->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stock Status</label>
                                            <select class="custom-select stock_status" name="stock_status[]" multiple="" required="">
                                                <option value="Hot">Hot</option>
                                                <option value="Upcoming">Upcoming</option>
                                                <option value="Limited">Limited</option>
                                                <option value="New Arrived">New Arrived</option>
                                                <option value="Out Of Stock">Out Of Stock</option>
                                            </select>
                                        </div>
                                    </div>



                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Product Image</label>-->
                                    <!--    <table class="table table-striped" id="productImage">-->
                                    <!--        <thead>-->
                                    <!--        <tr>-->
                                    <!--            <th>Image</th>-->
                                    <!--            <th>Image ALt</th>-->
                                    <!--            <th>Image Des</th>-->
                                    <!--            <th>Action</th>-->
                                    <!--        </tr>-->
                                    <!--        </thead>-->
                                    <!--        <tbody>-->
                                    <!--            <tr>-->
                                    <!--                <td><input type="file" class="form-control" name="product_image[]" ></td>-->
                                    <!--                <td><input type="text" class="form-control" name="product_image_alt[]" ></td>-->

                                    <!--                <td>-->
                                    <!--                    <textarea name="product_image_des[]" class="form-control" cols="30" rows="2" ></textarea>-->
                                    <!--                </td>-->

                                    <!--                <td> <button id="add"  type="button" class="btn btn-success btn-sm add"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--            </tr>-->
                                    <!--            <tr></tr>-->

                                    <!--        </tbody>-->
                                    <!--    </table>     -->
                                    <!--</div>-->


                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Highlights</label>-->
                                    <!--    <table class="table table-striped" id="highlights">-->
                                    <!--        <thead>-->
                                    <!--        <tr>-->
                                    <!--            <th>Title</th>-->
                                    <!--            <th>Action</th>-->
                                    <!--        </tr>-->
                                    <!--        </thead>-->
                                    <!--        <tbody>-->
                                    <!--            <tr>-->
                                    <!--                <td><input type="text" class="form-control" name="highlight[]" ></td>-->
                                    <!--                <td> <button id="highlights"  type="button" class="btn btn-success btn-sm highlights"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--            </tr>-->
                                    <!--            <tr></tr>-->

                                    <!--        </tbody>-->
                                    <!--    </table>     -->
                                    <!--</div>-->

                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Specification</label>-->
                                    <!--    <table class="table table-striped" id="specification">-->
                                    <!--        <thead>-->
                                    <!--        <tr>-->
                                    <!--            <th>Title</th>-->
                                    <!--            <th>Action</th>-->
                                    <!--        </tr>-->
                                    <!--        </thead>-->
                                    <!--        <tbody>-->
                                    <!--            <tr>-->
                                    <!--                <td><input type="text" class="form-control" name="specification[]" ></td>-->
                                    <!--                <td> <button id="specification"  type="button" class="btn btn-success btn-sm specification"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--            </tr>-->
                                    <!--            <tr></tr>-->

                                    <!--        </tbody>-->
                                    <!--    </table>     -->
                                    <!--</div>-->


                                    <!-- <div class="col-sm-12">
                                        <label for="inputEmail3" class="col-form-label">Terms & Conditions</label>
                                        <table class="table table-striped" id="productTerm">
                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="terms[]" ></td>
                                                    <td> <button id="productTerm"  type="button" class="btn btn-success btn-sm productTerm"><i class="fa fa-plus-circle"></i> </button></td>
                                                </tr>
                                                <tr></tr>

                                            </tbody>
                                        </table>     
                                    </div> -->


                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Description</label>-->
                                    <!--    <textarea name="description" id="summernote" class="textarea summernote" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>    -->
                                    <!--</div>-->

                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Short Des</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--      <input type="text" class="form-control" name="note" placeholder="Note" >-->
                                    <!--    </div> -->
                                    <!--</div>-->


                            	</div>



                                <div class="row">

                                    <div class="col-md-12"></div>

                                    <div class="form-group mt-5">
                                        <label for="exampleInputEmail1"><span class="text-danger">Product SEO</span></label>
                                    </div>
                                    <div class="col-md-12"></div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Meta Title">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                            <input type="text" name="meta_des" class="form-control" id="exampleInputEmail1" placeholder="Meta Description">
                                        </div>   
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" placeholder="Meta Keywords">
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