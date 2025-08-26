@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Order</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{route('admin/filter-order')}}" method="get">
                  @csrf
                   <div class="row mb-5">
                      <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><b> From <i class="text-danger">*</i> </b></label>
                          <input type="date" class="form-control" name="from_date" value="{{$from_date ?? ''}}">
                      </div>
                      <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><b> TO <i class="text-danger">*</i> </b></label>
                          <input type="date" class="form-control" name="to_date" value="{{$to_date ?? ''}}">
                      </div>
                      
                        <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><b> Invoice ID </b></label>
                          <input type="number" class="form-control" name="invoice_id"  value="{{$invoice_id ?? ''}}">
                      </div>



                      @if($admin->role_id == 1)
                      <div class="col-xl-2 col-md-2">
                        <label class="col-form-label"><b> Seller </b></label>
                        <select class="form-control select2" name="seller_id">
                            <option value="">----Select----</option>
                            @foreach($admins as $item)
                            <option value="{{$item->id}}"  @php echo $item->id == $seller_id?'selected':'';@endphp>{{$item->name}}</option>
                            @endforeach
                        </select>
                      </div>  
                      @endif

                      {{-- <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><b> Method <i class="text-danger">*</i> </b></label>
                          <select class="form-control selectric" name="payment_method">
                              <option value="">----Select----</option>
                              @foreach($methods as $method)
                              <option value="{{$method->title}}" @php echo $method->title == $payment_method?'selected':'';@endphp>{{$method->title}}</option>
                              @endforeach
                          </select>
                      </div>                                          --}}
                      {{-- <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><b>Status<i class="text-danger">*</i> </b></label>
                          <select class="form-control select2" name="status">
                              <option value="">----Select----</option>

                              <option value="0" @php echo $status == 0?'selected':'';@endphp>Pending</option>
                              <option value="1" @php echo $status == 1?'selected':'';@endphp>Processing</option>
                              <option value="2" @php echo $status == 2?'selected':'';@endphp>On the way</option>
                              <option value="3" @php echo $status == 3?'selected':'';@endphp>Delivered</option>
                              <option value="4" @php echo $status == 4?'selected':'';@endphp>Cancel</option>
                          </select>
                      </div>  --}}
                      <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><p></p></label><br>
                          <input type="submit" class="btn btn-success" value="Filter">

                      </div> 

                      <div class="col-xl-4 col-md-4" style="text-align: end;">
                        <label class="col-form-label"><p></p></label><br>

                        <a href="{{ route('admin/print_order_report', ['from_date' => $from_date, 'to_date' => $to_date, 'seller_id' => $seller_id, 'invoice_id' => $invoice_id]) }}"><button type="button"  class="btn btn-info w-50">Print</button></a>
                    </div> 


                  </div>
              </form>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Invoice ID</th>
                  <th>Seller</th>
                  <th>Total Amount</th>
                  <th>Pay</th>
                  <th>Return</th>
                  <!--<th>Discount</th>-->
                  <!--<th>S.Charge</th>-->
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @php 
              $i=1;
              $total_cost = 0; 
              $total_pay = 0; 
              $total_return = 0; 
            @endphp
            @foreach($orders as $order)

                @php 
                  $total_cost = $total_cost + $order->total_cost; 
                  $total_pay = $total_pay + $order->pay_amount; 
                  $total_return = $total_return + $order->return_amount; 

                  $payment_method = App\Models\PaymentMethod::where('id', $order->payment_method_id)->first();
                @endphp

                <tr>

                  	<td>{{$i++}}</td>
                    <td>{{$order->invoice_id}}</td>
                    <td>{{$order->admin->name ?? ''}}</td>
                    <td>
                        
                        {{$order->total_cost}} BDT
                        @if($order->payment_method == 'Cash on delivery')
                        
                            <br><span style="color: #e7661b;font-weight: bold;font-size: 13px;">Unpaid</span>
                        
                        @else
                        
                            <br><span style="color: #03a803;font-weight: bold;font-size: 13px;">Paid</span>
                        
                        @endif
                        
                        
                    </td>
                    <td>{{$order->pay_amount}} BDT</td>
                    <td>{{$order->return_amount}} BDT</td>
                    <td>{{$payment_method->title }}</td>
                    <!--<td>{{$order->discount ?? ''}} BDT</td>-->
                    <!--<td>{{$order->shipping_charge ?? ''}} BDT</td>-->
                    <td>
                      
                      <?php echo date('d-m-Y', strtotime($order->created_at)); ?>
                       
                      <?php
                          $currentDateTime = $order->created_at;
                          echo $newDateTime = date('h:i A', strtotime($currentDateTime));
                      ?>
                      
                    </td>

	                <td>
	                    @php
	                        if($order->status == 0){
	                           echo  "<div class='badge badge-warning badge-shadow'>Pending</div>";
	                         }
                           if($order->status == 1){
	                           echo  "<div class='badge badge-info badge-shadow'>Processing</div>";
	                         }
	                         if($order->status == 2){
                             echo  "<div class='badge badge-success badge-shadow'>On the way</div>";
                           }
                           if($order->status == 3){
                             echo  "<div class='badge badge-success badge-shadow'>Delivered</div>";
                           }
                           if($order->status == 4){
                             echo  "<div class='badge badge-danger badge-shadow'>Canceled</div>";
                           }
	                    @endphp
                      
	                </td>
                  	<td>

                      <div class="row">
                        <a href="{{URL::to('admin/order/'.$order->id)}}" title="View" style="float: left;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>
                            </button>
                        </a>                        
                        
                        
                      @if($admin->role_id == 1)
                        <a href="{{URL::to('admin/order/'.$order->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                            </button>
                        </a>


                        <a href="{{ route('admin/assign-delivery-man', $order->id) }}" title="Edit" style="float: left;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-truck"></i>
                            </button>
                        </a>

              
                        <form action="{{URL::to('admin/order/'.$order->id)}}" method="post">
                        	@csrf
                        	@method('DELETE')
                        	<button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                        @endif
                        
                        
                      </div>


                  	</td>
                </tr>
				@endforeach
	
                </tbody>

                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td> <strong>Total Balance: {{ $total_cost ?? '' }} TK</strong> </td>
                    <td><strong>Total Cutomer Pay: {{ $total_pay ?? '' }} TK</strong></td>
                    <td><strong>Total Cutomer Return: {{ $total_return ?? '' }} TK</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.card-body -->
          </div>

       
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>



@endsection