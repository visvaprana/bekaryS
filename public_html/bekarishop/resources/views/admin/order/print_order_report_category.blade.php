<!DOCTYPE html>
<html lang="en">
<head>
  <title>Print Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>



<div class="container">
  <div class="row">

    <div class="col-md-12" style="text-align: center;">

        <br>
        <button class="btn btn-danger" type="button" onclick="printDiv('printableArea')" style="  width: 150px; font-size: 20px;">Print</button>


    </div>

    <div class="col-sm-12" id="printableArea">

        <div style="text-align: center;">
            <p style="font-size: 25px;font-weight: bold;margin-top: 20px;">Report</p>

            <p style="font-weight: bold;">
                Date: {{ $from_date }}
                Category: {{ $category->name }}
                
                @if($to_date)
                - {{ $to_date }}
                @endif
                
                @if($seller_id)
                - Seller : {{ $seller->name }}
                @endif
    
            </p>
        </div>


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

  </div>
</div>

<script type="text/javascript"> 

    function printDiv(divId) {
       var printContents = document.getElementById(divId).innerHTML;
       var originalContents = document.body.innerHTML;
       document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
       window.print();
       document.body.innerHTML = originalContents;
    }

</script>

</body>
</html>
