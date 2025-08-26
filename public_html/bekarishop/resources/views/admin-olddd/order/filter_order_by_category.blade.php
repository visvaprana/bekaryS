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
              <form action="{{route('admin/filter-order-by-category')}}" method="get">
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


                        <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><b> Category  </b> </label>
                          <select class="form-control selectric" name="category_id" requried>
                              <option value="">----Select----</option>
                              @foreach($categories as $item)
                              <option value="{{$item->id}}" @php echo $item->id == $category_id?'selected':'';@endphp>{{$item->name}}</option>
                              @endforeach
                          </select>
                        </div> 
                        
                        
                      <div class="col-xl-2 col-md-2">
                          <label class="col-form-label"><p></p></label><br>
                          <input type="submit" class="btn btn-success" value="Filter">

                      </div> 

                        <div class="col-xl-2 col-md-2" style="text-align: end;">
                            <label class="col-form-label"><p></p></label><br>
                            <a href="{{ route('admin/print_order_report_category', ['from_date' => $from_date, 'to_date' => $to_date, 'seller_id' => $seller_id, 'category_id' => $category_id]) }}"><button type="button"  class="btn btn-info w-50">Print</button></a>
                        </div> 


                  </div>
              </form>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Invoice ID</th>
                  <th>Seller</th>
                  <th>Category</th>
                  <th>Product Price</th>
                  <th>QTY</th>
                  <th>Total</th>
                  <th>Date</th>

                </tr>
                </thead>
                <tbody>
            @php 
              $i=1;
              $total_qty = 0; 
              $total_amount = 0; 
            @endphp
            @foreach($orders as $order)

                @php 
                    $total_qty = $total_qty + $order->qty; 
                    $total_amount = $total_amount + $order->qty_total_amount; 
                  
                    $seller = App\Models\Admin::where('id', $order->admin_id)->first();
                    $product_unit = App\Models\ProductUnit::where('product_id', $order->product_id)->first();
                   
                @endphp

                <tr>

                  	<td>{{$i++}}</td>
                    <td>{{$order->invoice_id}}</td>
                    <td>{{$seller->name ?? ''}}</td>
                    <td>{{$order->category->name ?? ''}}</td>
                    <td>{{$order->product_price ?? ''}} BDT</td>
                    <td>{{$order->qty ?? ''}} ( {{ $product_unit->unit->name ?? '' }} )</td>
                    <td>{{$order->qty_total_amount ?? ''}} BDT</td>
               
                    
                    <td>
                      <?php echo date('d-m-Y', strtotime($order->created_at)); ?>
                       
                      <?php
                          $currentDateTime = $order->created_at;
                          echo $newDateTime = date('h:i A', strtotime($currentDateTime));
                      ?>
                      
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
                    <td></td>
    
                    <td></td>
                    <td><strong>Total Amount: {{ $total_amount ?? '' }} TK</strong></td>
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