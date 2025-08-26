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
              <th>Quantity</th>
              <th>Total Amount</th>
              <th>Pay</th>
              <th>Return</th>
              <th>Date</th>
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
            @endphp

            <tr>

                  <td>{{$i++}}</td>
                <td>{{$order->invoice_id}}</td>
                <td>{{$order->admin->name ?? ''}}</td>
                <td>{{$order->total_qty}}</td>
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
                <!--<td>{{$order->discount ?? ''}} BDT</td>-->
                <!--<td>{{$order->shipping_charge ?? ''}} BDT</td>-->
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
                <td> <strong>Total Balance: {{ $total_cost ?? '' }} TK</strong> </td>
                <td><strong>Total Cutomer Pay: {{ $total_pay ?? '' }} TK</strong></td>
                <td><strong>Total Cutomer Return: {{ $total_return ?? '' }} TK</strong></td>
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
