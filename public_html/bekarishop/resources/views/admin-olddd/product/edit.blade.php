@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Edit </title>
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
                    <h1>Product Edit Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Edit Form</li>
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" action="{{URL::to('admin/product/'.$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class="card-body">


                            	<div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Serial</label>
                                            <input type="number" name="serial" value="{{$data->serial}}" class="form-control" id="exampleInputEmail1" required="">
                                        </div> 
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Item Title</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Item Name" required="" value="{{$data->name}}">
                                        </div> 
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Item Slug</label>
                                            <input type="text" name="slug" class="form-control" id="exampleInputEmail1" placeholder="Item Slug" required="" value="{{$data->slug}}" readonly="">
                                        </div> 
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code</label>
                                            <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Product Code"  value="{{$data->code}}">
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product SKU</label>
                                            <input type="text" name="sku" class="form-control" id="exampleInputEmail1" placeholder="Product SKU"  value="{{$data->sku}}">
                                        </div> 
                                    </div> -->




	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Menu<span style="color: red">*</span></label>
		                                    
		                                    <select name="category_id[]" id="category_id" class="form-control productCategory" required="">
                                                @foreach($categories as $category)
                                                    @if(count($ProductCategories) > 0)
                                                        @foreach($ProductCategories as $ProductCategory)
                                                            <option value="{{$category->id}}" @if($ProductCategory->category_id == $category->id) selected="" @endif>{{$category->name ?? ''}}</option>
                                                        @endforeach
                                                        
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->name ?? ''}}</option>
                                                    @endif
                                                @endforeach
		                                    </select>
		                                </div>
	                            	</div>

	                            	<!-- <div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Brand<span style="color: red">*</span></label>
		                                    <select name="brand_id[]" id="brand_id" class="form-control brand_id" required="" multiple="multiple">
                                                @foreach($brands as $brand)
                                                    @if(count($productBrands) > 0)
                                                        @foreach($productBrands as $productBrand)
                                                            <option value="{{$brand->id}}" @if($productBrand->brand_id == $brand->id) selected="" @endif>{{$brand->name ?? ''}}</option>
                                                        @endforeach
                                                        
                                                    @else
                                                        <option value="{{$brand->id}}">{{$brand->name ?? ''}}</option>
                                                    @endif
                                                @endforeach
		                                    </select>
		                                </div>
	                            	</div> -->


                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Color<span style="color: red">*</span></label>
                                            <select name="color_id[]" id="color_id" class="form-control color_id"  multiple="multiple">
                                                @foreach($colors as $color)
                                                    @if(count($ProductColors) > 0)
                                                        @foreach($ProductColors as $ProductColor)
                                                            <option value="{{$color->id}}" @if($ProductColor->color_id == $color->id) selected="" @endif>{{$color->name ?? ''}}</option>
                                                        @endforeach
                                                        
                                                    @else
                                                        <option value="{{$color->id}}">{{$color->name ?? ''}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Size<span style="color: red">*</span></label>
                                            <select name="size_id[]" id="size_id" class="form-control size_id"  multiple="multiple">
                                                @foreach($sizes as $size)
                                                    @if(count($ProductSizes) > 0)
                                                        @foreach($ProductSizes as $ProductSize)
                                                            <option value="{{$size->id}}" @if($ProductSize->size_id == $size->id) selected="" @endif>{{$size->name ?? ''}}</option>
                                                        @endforeach
                                                        
                                                    @else
                                                        <option value="{{$size->id}}">{{$size->name ?? ''}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Unit<span style="color: red">*</span></label>
                                            <select name="unit_id[]" id="unit_id" class="form-control unit_id">
                                                @foreach($units as $unit)
                                                    @if(count($ProductUnits) > 0)
                                                        @foreach($ProductUnits as $ProductUnit)
                                                            <option value="{{$unit->id}}" @if($ProductUnit->unit_id == $unit->id) selected="" @endif>{{$unit->name ?? ''}}</option>
                                                        @endforeach
                                                        
                                                    @else
                                                        <option value="{{$unit->id}}">{{$unit->name ?? ''}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Buying Price</label>
                                            <input type="number" step=".01" name="buying_price" class="form-control" id="exampleInputEmail1" required="" value="{{$data->buying_price}}">
                                        </div>
                                    </div> -->


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Selling Price</label>
                                            <input type="number" step=".01" name="sell_price" class="form-control " id="sell_price" required="" value="{{$data->sell_price}}">
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount ( % )</label>
                                            <input type="number" name="discount" class="form-control" id="discount" value="{{$data->discount}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">Calculate ( = )</label> <br>
                                        <button type="button" class="btn btn-info w-100" onclick="calculateDiscount()"> = </button>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount Price</label>
                                            <input type="number" step=".01" name="discount_price" class="form-control" id="discount_price" readonly="" value="{{$data->discount_price}}">
                                        </div>
                                    </div> --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product QTY</label>
                                            <input type="number" name="qty" class="form-control" id="exampleInputEmail1" required="" value="{{$data->qty}}">
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-4">
                                        <label for="inputEmail3" class=" col-form-label">Min Order Qty</label>
                                        <input type="number" class="form-control" name="min_order_qty" value="{{$data->min_order_qty}}">
                                    </div>  
                                    
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class=" col-form-label">Max Order Qty</label>
                                        <input type="number" class="form-control" name="max_order_qty" value="{{$data->max_order_qty}}">
                                    </div> --> 
                                    
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class=" col-form-label">Fetaure Image</label>
                                        <input type="file" class="form-control" name="image">

                                        @if(isset($data))
                                        <div class="form-group">
                                            <img src="{{ asset($data->image) }}" alt="Image" style="width: 30%; margin-top: 8px">
                                            <input type="hidden" name="old_image" value="{{ $data->image }}">
                                        </div>
                                        @endif

                                    </div> 
                                    
                                    <!--<div class="col-sm-4">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Fetaure Image Alt</label>-->
                                    <!--    <input type="text" class="form-control" name="image_alt" placeholder="Fetaure Image Alt" value="{{ $data->image_alt }}">-->
                                    <!--</div>-->

                                    <!--<div class="col-sm-4">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Fetaure Image Description</label>-->
                                    <!--    <textarea name="image_des" class="form-control" cols="30" rows="2">{{  $data->image_des  }}</textarea>-->
                                    <!--</div>-->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stock Status</label>
                                            <select class="custom-select stock_status" name="stock_status[]" multiple="" required="">
                                                @foreach($ProductStockStatus as $status)
                                                <option value="Hot" @php echo $status->stock_status=='Hot'?"selected":""; @endphp>Hot</option>
                                                <option value="Upcoming" @php echo $status->stock_status=='Upcoming'?"selected":""; @endphp>Upcoming</option>
                                                <option value="Limited" @php echo $status->stock_status=='Limited'?"selected":""; @endphp>Limited</option>
                                                <option value="New Arrived" @php echo $status->stock_status=='New Arrived'?"selected":""; @endphp>New Arrived</option>
                                                <option value="Out Of Stock" @php echo $status->stock_status=='Out Of Stock'?"selected":""; @endphp>Out Of Stock</option>
                                                @endforeach
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

                                    <!--            @if(count($ProductHighLights)>0)-->
                                    <!--                @foreach($ProductHighLights as $ProductHighLight)-->
                                    <!--                <tr>-->
                                    <!--                    <td><input type="text" class="form-control" name="highlights[]" value="{{ $ProductHighLight->highlights ?? '' }}"></td>-->
                                    <!--                    <td> <button id="highlights"  type="button" class="btn btn-success btn-sm highlights"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--                </tr>-->
                                    <!--                @endforeach-->
                                    <!--            @else-->
                                    <!--                <tr>-->
                                    <!--                    <td><input type="text" class="form-control" name="highlights[]" ></td>-->
                                    <!--                    <td> <button id="highlights"  type="button" class="btn btn-success btn-sm highlights"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--                </tr>-->
                                    <!--            @endif-->
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
                                    <!--            @if(count($ProductSpecifications)>0)-->
                                    <!--                @foreach($ProductSpecifications as $ProductSpecification)-->
                                    <!--            <tr>-->
                                    <!--                <td><input type="text" class="form-control" name="specification[]" value="{{ $ProductSpecification->specification ?? '' }}"></td>-->
                                    <!--                <td> <button id="specification"  type="button" class="btn btn-success btn-sm specification"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--            </tr>-->
                                    <!--            @endforeach-->
                                    <!--            @else-->
                                    <!--                <tr>-->
                                    <!--                    <td><input type="text" class="form-control" name="specification[]" ></td>-->
                                    <!--                    <td> <button id="specification"  type="button" class="btn btn-success btn-sm specification"><i class="fa fa-plus-circle"></i> </button></td>-->
                                    <!--                </tr>-->
                                    <!--            @endif-->
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
                                                @if(count($ProductTerms)>0)
                                                    @foreach($ProductTerms as $ProductTerm)
                                                <tr>
                                                    <td><input type="text" class="form-control" name="terms[]" value="{{ $ProductTerm->terms ?? '' }}"></td>
                                                    <td> <button id="productTerm"  type="button" class="btn btn-success btn-sm productTerm"><i class="fa fa-plus-circle"></i> </button></td>
                                                </tr>
                                                @endforeach
                                                @else
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="terms[]" ></td>
                                                        <td> <button id="productTerm"  type="button" class="btn btn-success btn-sm productTerm"><i class="fa fa-plus-circle"></i> </button></td>
                                                    </tr>
                                                @endif
                                                <tr></tr>

                                            </tbody>
                                        </table>     
                                    </div> -->


                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Description</label>-->
                                    <!--    <textarea name="description" id="summernote" class="textarea summernote" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!  $data->description  !!}</textarea>    -->
                                    <!--</div>-->

                                    <!--<div class="col-sm-12">-->
                                    <!--    <label for="inputEmail3" class="col-form-label">Short Des</label>-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--      <input type="text" class="form-control" name="note" placeholder="Note" value="{{ $data->note }}">-->
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
                                            <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Meta Title" value="{{ $data->meta_title }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Description</label>
                                            <input type="text" name="meta_des" class="form-control" id="exampleInputEmail1" placeholder="Meta Description"  value="{{ $data->meta_des }}">
                                        </div>   
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" placeholder="Meta Keywords"  value="{{ $data->meta_keywords }}">
                                        </div>
                                    </div>


                                </div>




                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Publication Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1" @php echo $data->status==1?"selected":""; @endphp>Active</option>
                                                <option value="0" @php echo $data->status==0?"selected":""; @endphp>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </form>



                        <form action="{{route('admin/update-multi-image')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12 mt-5" style="padding: 10px 50px;background: aliceblue;">
                                <label for="inputEmail3" class="col-form-label">Multi Image</label>
                                @if(count($productImages) > 0)
                                    @foreach($productImages as $productImage)
                                        @if(isset($productImage))
                                            <div class="form-group">
                                                <img src="{{ asset($productImage->product_image) }}" alt="Image" style="width: 5%">
                                                <input type="hidden" name="old_product_image[]" value="{{ $productImage->id }}">
                                            </div>
                                        @endif
                                    <table class="table table-striped" id="productImage">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Image ALt</th>
                                            <th>Image Des</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <input type="hidden" value="{{$data->id}}" name="product_id">
                                                <td><input type="file" class="form-control" name="product_image[{{$productImage->id}}]"></td>
                                                <td><input type="text" class="form-control" name="product_image_alt[]" value="{{$productImage->product_image_alt}}"></td>

                                                <td>
                                                    <textarea name="product_image_des[]" class="form-control" cols="30" rows="2">{{$productImage->product_image_des}}</textarea>
                                                </td>

                                                <td>

                                                    <a href="{{route('admin/delete-multi-image', [$productImage->id])}}"><button  type="button" class="btn btn-danger "><i class="fa fa-trash"></i> </button></a>
                                                </td>
                                            </tr>
                                            <tr></tr>

                                        </tbody>
                                    </table>  
                                @endforeach
                                @else
                                    <table class="table table-striped" id="productImage">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Image ALt</th>
                                            <th>Image Des</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <input type="hidden" value="{{$data->id}}" name="product_id">
                                                <td><input type="file" class="form-control" name="product_image[]" ></td>
                                                <td><input type="text" class="form-control" name="product_image_alt[]" ></td>

                                                <td>
                                                    <textarea name="product_image_des[]" class="form-control" cols="30" rows="2" ></textarea>
                                                </td>

                                                
                                            </tr>
                                            <tr></tr>

                                        </tbody>
                                    </table> 
                                @endif
                                <button type="submit" class="btn btn-primary float-sm-right mb-5">Update Image</button>

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