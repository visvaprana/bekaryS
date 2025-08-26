@extends('admin.layouts.app')

@section('content')



  <div class="content-wrapper">
    <section class="content mt-5">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
            <!-- general form elements -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Shipping Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('admin/update-shipping-address', [$order->id])}}" method="post">
              	@csrf
                <div class="card-body">
	                  	
                  <div class="row">


                    <div class="col-md-6">
                      <div class="form-group">
                        <label >First Name</label>
                        <input name="fname" type="text" class="form-control" value="{{$user->fname ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label >Last Name</label>
                        <input name="lname" type="text" class="form-control" value="{{$user->lname ?? ''}}">
                      </div>
                    </div>


                    <div class="col-md-12">
                      
                      <div class="form-group">
                        <label>Address </label>
                        <input type="text" class="form-control" name="address" value="{{$user->address ?? ''}}">
                      </div>

                    </div>  

                    <div class="col-md-6">
                      <div class="form-group">
                        <label >City</label>
                        <input name="city" type="text" class="form-control" value="{{$user->city ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label >Area</label>
                        <input name="area" type="text" class="form-control" value="{{$user->area ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label >Post Code</label>
                        <input name="postcode" type="text" class="form-control" value=" {{$user->postcode ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label >Phone Number</label>
                        <input name="phone" type="text" class="form-control" value=" {{$user->phone ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label >Email</label>
                        <input name="email " type="text" class="form-control" value="{{$user->email  ?? ''}}">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->

          <div class="col-md-6">
            <!-- general form elements -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><strong>Order Summery</strong></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('admin/update-order-summery', [$order->id])}}" method="post">
              	@csrf
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Total QTY</label>
                        <input name="total_qty" type="text" class="form-control" value="{{$order->total_qty}}" readonly="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      

                      <div class="form-group">
                        <label >Subtotal</label>
                        <input name="" type="text" class="form-control" value="{{$toal_p_price}}" readonly="">
                      </div>

                      
                      @foreach($orderDetails as $details)
                        <div class="row">
                          <input type="hidden" name="product_id[]" value="{{$details->product->id ?? ''}}">
                          <input type="hidden" name="qty[]" value="{{$details->qty}}">
                        </div>
                      @endforeach

                    </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label >Dicount</label>
                          <input name="" type="text" class="form-control" value="{{$order->discount ?? 0}}" readonly="">
                        </div>
                      </div>
                      <div class="col-md-4">

                        <div class="form-group">
                          <label >Coupon Code</label>
                          <input name="" type="text" class="form-control" value="{{$order->coupone_code ?? ''}}" readonly="">
                        </div>
                      </div>

                    <div class="col-md-4">




                      <div class="form-group">
                        <label >Shipping</label>
                        <input name="" type="text" class="form-control" value="{{$order->shipping_charge}}" readonly="">
                      </div>

                    </div>

                    <div class="col-md-4">




                      <div class="form-group">
                        <label >Urget Charge</label>
                        <input name="" type="text" class="form-control" value="{{$order->urgent_charge}}" readonly="">
                      </div>

                    </div>
                    
                    
                    
                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label >Tax</label>
                        <input name="" type="text" class="form-control" value="{{$site_info->tax}}" readonly="">
                      </div>

                    </div>
                    <div class="col-md-6">
                      
                      <div class="form-group">
                        <label >Total Cost</label>
                        <input name="total_cost" type="text" class="form-control" value="{{ $order->total_cost }}" readonly="">
                      </div>

                    </div>
                    <div class="col-md-6">
                      
                      <div class="form-group">
                        <label>Delivery Method</label>
                        <input name="payment_method" type="text" class="form-control" value="{{$order->payment_method}}" readonly="">
                      </div>    

                    </div>
                    <div class="col-md-12">
                      
              
                      <div class="form-group">
                        <label >Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="0" @php echo $order->status==0?"selected":""; @endphp>Pending</option>
                            <option value="1" @php echo $order->status==1?"selected":""; @endphp>Processing</option>
                            <option value="2" @php echo $order->status==2?"selected":""; @endphp>On The Way</option>
                            <option value="3" @php echo $order->status==3?"selected":""; @endphp>Delivered</option>
                            <option value="4" @php echo $order->status==4?"selected":""; @endphp>Canceled</option>
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

          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><strong>Order Details</strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    @foreach($orderDetails as $details)
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="inputName">Product Name</label>
                          
                          <p>{{$details->product->name ?? ''}} ( Price: {{ $details->product_price }} )</p>
                        </div>   
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">Qty</label>
                          <p>{{$details->qty}}</p>
                        </div>   
                    </div>              
 

                    <div class="col-md-2">
                        <div class="form-group">
                          
                        </div>   
                    </div> 

                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="inputName">Size</label>
                          <p>
                            @if($details->size)
                            {{$details->size}}
                            @else
                              -
                            @endif
                          </p>
                        </div>   
                    </div>  
                    @endforeach  
                  </div>

                  </div>

                </form>
              </div>
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



@endsection