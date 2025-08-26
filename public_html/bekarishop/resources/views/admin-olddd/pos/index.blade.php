@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | POS</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')


<style>
    .product_card{
        border: 1px solid #e1e1e1;
        padding: 6px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
       
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

          
                <div class="col-md-7">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="">
                            <div class="card-header">
                                <h3 class="card-title"> Products </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select name="category_id" id="category_id" class="form-control" onchange="getProducts(this.value)">
                                                <option value="">Select</option>
                                                @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Search</label>
                                            <input type="text" class="form-control" name="product_name" onkeyup="getProductsByName(this.value)" placeholder="Enter Product Name">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1" ><span style="color: red">ORDER QUANTITY *</span> </label> <br>
                                        <input type="text" class="form-control order_qty" value="1" required min="1">
                                    </div>


                                    <div class="col-md-12">

                                        <div class="loading-overlay" style="display: none;">
                                            <!-- Add your loading spinner or message here -->
                                            Loading...
                                        </div>

                                        <audio id="myAudio">
                                            <source src="{{asset('assets/sound.mp3')}}/" type="audio/mp3">
                                            Your browser does not support the audio element.
                                        </audio>

                                        <div class="search_products">
                                         
                                           
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
    


  
                <div class="col-md-5">
                    <!-- general form elements -->
                    <div class="card card-primary item-form">
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
                            <h3 class="card-title">Products</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->


                  

                            <div class="card-body " style="padding: 0">

                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Select Customer <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Add new Customer +</a> </label>
                                        <select name="user_id" id="user_id" class="form-control js-example-basic-multiple">
                                            <option value="">Select</option>
                                            @foreach($users as $item)
                                            <option value="{{$item->id}}">{{$item->fname}} {{$item->lname}} - {{$item->phone}} - Address: {{$item->address}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br> --}}

                                <form action="{{ route('admin/submit_order_admin') }}" method="get">
                                    @csrf

                                <div class="cartItem">

    
                                    <table class="table table-striped cart-list">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Product
                                                </th>
                                                <th>
                                                    Unit
                                                </th>
                                                <th>
                                                    Price
                                                </th>
                                                <th>
                                                    Quantity <br> ( 500 Gram = 0.5 kg )
                                                </th>
                                                <th>
                                                    Subtotal
                                                </th>
                                                <th>
                                                    Delete
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                    
                                            
                                            
                                                @foreach($contents as $content)
                                                @if($content->rowId)
                                                    <input type="hidden" name="rowid[]" value="{{$content->rowId}}">
                                                @endif
                                            
                                                <?php
                                                    $product = App\Models\Product::where('id', $content->id)->first();
                                                    if($product){
                                                        $product_unit = App\Models\ProductUnit::where('product_id', $product->id)->first();
                                                    }
                                                    
                                                 
                                                 
                                                ?>
                                            
                                                <tr class="">
                    
                                                    <td>
                                                        <span class="item_cart">{{ $content->name }}</span>
                                                        <input type="hidden" name="product_id[]" value="{{$product->id}}">
                                                    </td>

                                                    <td>
                                                        <span class="item_cart">{{ $product_unit->unit->name ?? '' }}</span>
                                                    </td>
        
                                                    <td>
                                                        <strong>৳<span class="cart_unit_price">{{$content->price}}</span></strong>
                                                    </td>
                                            
                                                    <td>
                                                        <div class="numbers-row">
                                                            <input type="text"   id="" class="qty2" name="quantity[]" data-id="{{$content->rowId}}" value="{{$content->qty}}" min="1" onkeyup="updateCart(this)" style="width: 90px">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <strong>৳ <span class="cart_sub_total">{{$content->price * $content->qty}}</span> </strong>
                                                    </td>
                                                    <td class="options">
                                                        <a href="{{ route('admin/remove_from_cart_admin', $content->rowId) }}"><img src="{{ asset('assets/frontend/') }}/css/SVG/close.svg" alt=""></a>
                                                        
                                                        {{-- <a href="#" class="DeleteCartItem" data-id="{{$content->rowId}}"><img src="{{ asset('assets/frontend/') }}/css/SVG/close.svg" alt=""></a> --}}
                                                    </td>
                                            
                                                </tr>
                                                @endforeach
                                                
        
                                            
                                            
                                        </tbody>
                                        <tfoot>
                                                    
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="3"> 
                                                    <?php 
                                                        $totalPrice = $sub_total;
                                                    ?>
                                                    <span>Total:</span><br> <input type="text" name="total" class="total" value="{{ floatval($totalPrice); }}" readonly>
                                                </td>
                                            
                                            </tr>
        
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2"> 
                                                    <?php 
                                                        $totalPrice = $sub_total;
                                                    ?>
                                                    <span>Pay:</span> <br><input type="text" name="pay" class="pay" value="" onkeyup="calculateRetun(this.value)" required>
                                                </td>
                                            
                                            </tr>

        
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2"> 
                                                    <?php 
                                                        $totalPrice = $sub_total;
                                                    ?>
                                                    <span>Return:</span><br> <input type="text" name="return" class="return" value="" required>
                                                </td>
                                            
                                            </tr>

        
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2"> 
                                                  
                                                    <span>Payment Method:</span><br> 
                                                    <select name="payment_method_id" id="" required>
                                                        <!--<option value="">Select</option>-->

                                                        @foreach($payment_methods as $item)

                                                            <option @if($item->id == 1) selected @endif value="{{$item->id}}">{{$item->title}}</option>

                                                        @endforeach
                                                    </select>
                                                </td>
                                            
                                            </tr>

        
        
                                        </tfoot>
                                    </table>

         

                                </div>
                                <div style="text-align: center; padding: 20px;">

                                    <a href="{{ route('admin/clear_cart') }}"><button type="button" class="btn btn-danger w-25">Clear</button></a>

                                    <button type="submit" class="btn btn-info  w-25">Pay Now</button>
            
                                </div>

                            </form>

                            

                            </div>


                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">


      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add a new customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>


          <div class="modal-body">

            <form role="form" action="{{route('admin/add_new_user')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
    
    
    
                    <div class="row">
                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name <span style="color: red">*</span> </label>
                                <input type="text" name="fname" class="form-control" id="exampleInputEmail1" placeholder="First Name" required>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last Name <span style="color: red">*</span></label>
                                <input type="text" name="lname" class="form-control" id="exampleInputEmail1" placeholder="Last Name" required>
                            </div>
                        </div>
                    
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                        </div>
                                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number <span style="color: red">*</span></label>
                                <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone Number" required>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">City <span style="color: red">*</span></label>
                                <br>
                                <select name="city_id" id="city_id" class="form-control" onchange="GetArea(this.value)">
                                    <option value="">Select</option>
                                    @foreach($cities as $item)
                                    <option value="{{$item->id}}">{{$item->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Area <span style="color: red">*</span></label>
                                <br>
                                <select name="area_id" id="area_id" class="form-control">
                                    <option value="">Select</option>
                                   
                                </select>
                            </div>
                        </div>

                     
    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address <span style="color: red">*</span></label>
                                <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Address" >
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


      </div>
    </div>
  </div>

@endsection
@section('script')
    @include('admin.layouts.js_script_backend')
@endsection