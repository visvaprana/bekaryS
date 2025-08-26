@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Assign Delivery Man To Order </title>
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
                	<p>Assign Delivery Man To Order</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assign Delivery Man To Order</li>
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

                <div class="col-md-7">


                	<div style="background: #ebebeb; padding: 14px;">

                	    <div class="row" style="justify-content: space-between;">
                	         <span style="font-weight: 900;font-size: 25px;">Invoice ID: {{$order->invoice_id}}</span>

                	         <a href="{{URL::to('admin/invoice/'.$order->id)}}" target="_blank"> <button class="btn btn-danger text-white"> <i class="fa fa-print"></i> Print Invoice </button></a>
                	    </div>



                	    	<br>
                	    	<br>
{{--                	    	@dd($order)--}}
                		<address>
        	              <strong>Order By: {{$user->fname ?? ''}} {{ $user->lname ?? ''}}</strong><br>

        	              <strong>Address:</strong> {{$user->address ?? ''}}

        	               {{$user->city ?? ''}}  {{ $user->postcode ?? ''}}

        	              <br>

        	             <strong> Phone:</strong> {{$user->phone ?? ''}}<br>

        	            <strong>  Email:</strong> {{$user->email ?? ''}}
        	            </address>


                        	<span style="font-weight: 900;">Quantity: {{$order->total_qty}}</span> - &nbsp; &nbsp;

        	    		<span style="font-weight: 900;"> Delivery Charge:  ৳ {{$order->shipping_charge ?? ''}} BDT </span> - &nbsp; &nbsp;



        	    		@if($order->urgent_charge > 0)
        	    		<span style="font-weight: 900;">Urgent Charge:   ৳  {{$order->urgent_charge ?? 0}} BDT</span>    - &nbsp; &nbsp;
        	    		@endif


        	    		<span style="font-weight: 900;">Total Cost:   ৳  {{$order->total_cost}} BDT</span>



        	    		<hr>
        	    		<br>





        	    		<table class="table table-striped">
                            <thead>
                        <tr>
                          <th>#</th>
                          <th>Product</th>
                          <th>Size</th>
                          <th>Qty</th>
                          <th>Unit Price</th>
                          <th>Subtotal</th>
                        </tr>
                        </thead>
                            <tbody>
                          @php $i=1; @endphp
                        @foreach($orderDetails as $details)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{$details->product->name ?? ''}}</td>


                          <td>

                            @if($details->size)
                              {{$details->size}}
                            @else
                              -
                            @endif

                          </td>
                          <td>{{$details->qty}}</td>
                          <td>৳ {{$details->product_price ?? ''}}</td>
                          <td>৳ {{$details->qty_total_amount ?? ''}}</td>
                        </tr>
                        @endforeach

                        </tbody>
                      </table>

                	</div>

                </div>


                <div class="col-md-5">
                    <!-- general form elements -->


                    @if(isset($delivery_man))
                        <div style="background: #ebebeb; padding: 14px;">

                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($delivery_man->image ?? '') }}" style="width: 100%;">
                            </div>

                            <div class="col-md-8">

                        		<address>
                	              <strong> Delivery Man:

                	              <br>

                	                Name: {{$delivery_man->name ?? ''}}</strong> <br>

                	                Phone: {{$delivery_man->phone ?? ''}} <br>

                	                Email: {{$delivery_man->email ?? ''}} <br>

                	                NID: {{$delivery_man->nid ?? ''}} <br>

                	                Address: {{$delivery_man->address ?? ''}} <br>


                	            </address>


                            </div>
                        </div>









                	</div>
                    @endif

                    <div class="card card-primary employee-form">
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
                            <h3 class="card-title">Assign Delivery Man To Order</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin/assign_delivery_man_store')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                            	<div class="row">
                            		<div class="col-md-12">

		                                <div class="form-group">

		                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

		                                    <label for="exampleInputEmail1">Delivery Man</label>
		                                    <select name="employee_id" class="form-control select2" id="" requried>

		                                    	<option value="">--- Select ---</option>

		                                    	@if(isset($delivery_man))

		                                    	    @foreach($employees as $item)
    		                                    	    <option value="{{$item->id}}"  @php echo $delivery_man->id==$item->id?"selected":""; @endphp>{{$item->name}} - Phone: {{ $item->phone }} - NID: {{ $item->nid }}</option>
    		                                    	@endforeach

		                                    	@else

		                                    	@foreach($employees as $item)
		                                    	    <option value="{{$item->id}}">{{$item->name}} - Phone: {{ $item->phone }} - NID: {{ $item->nid }}</option>
		                                    	@endforeach

		                                    	@endif



		                                    </select>
		                                </div>

		                                <div class="form-group">

		                                    <input type="hidden" name="order_id" value="{{ $order->id }}">

		                                    <label for="exampleInputEmail1"> Change Order Status </label>
                    	                   <select name="status" id="" class="form-control" requried>

                    	                        <option value=""> --- Select ---</option>

                                                <option value="0" @php echo $order->status==0?"selected":""; @endphp>Pending</option>
                                                <option value="1" @php echo $order->status==1?"selected":""; @endphp>Processing</option>
                                                <option value="2" @php echo $order->status==2?"selected":""; @endphp>On The Way</option>
                                                <option value="2" @php echo $order->status==3?"selected":""; @endphp>Delivered</option>
                                                <option value="3" @php echo $order->status==4?"selected":""; @endphp>Canceled</option>

                                            </select>
		                                </div>


                            		</div>
                            		<!--<div class="col-md-6">-->

		                            <!--    <div class="form-group">-->
		                            <!--        <label for="exampleInputEmail1">Name</label>-->
		                            <!--        <input type="text" name="name" class="form-control" id="exampleInputEmail1" readonly="">-->
		                            <!--    </div>-->

                            		<!--</div>-->
                            		<!--<div class="col-md-6">-->

		                            <!--    <div class="form-group">-->
		                            <!--        <label for="exampleInputEmail1">Phone</label>-->
		                            <!--        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"  readonly="">-->
		                            <!--    </div>-->

                            		<!--</div>-->
                            		<!--<div class="col-md-6">-->

		                            <!--    <div class="form-group">-->
		                            <!--        <label for="exampleInputEmail1">NID</label>-->
		                            <!--        <input type="text" name="nid" class="form-control" id="exampleInputEmail1" readonly="">-->
		                            <!--    </div>-->

                            		<!--</div>-->
                            	</div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Assign</button>
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
