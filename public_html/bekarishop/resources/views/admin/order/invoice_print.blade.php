<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>{{$shipping_address->s_fname ?? ''}} {{$shipping_address->s_lname ?? ''}} Invoice</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
            <img src="{{asset($site_image->logo)}}" alt="{{$site_info->site_name}}">


            <small class="float-right">Date to day:

                <?php echo date('d-m-Y', strtotime($order->created_at)); ?>

                <?php
                    $currentDateTime = $order->created_at;
                    echo $newDateTime = date('h:i A', strtotime($currentDateTime));
                ?>

            </small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
            <address>
              <strong>{{$site_info->site_name}}.</strong><br>
              {{$site_info->address}}<br>
              Phone:  {{$site_info->phone}}<br>
              Email:  {{$site_info->email}}
            </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
          Shipping Address :
            <address>
              <strong>{{$shipping_address->s_fname ?? ''}} {{ $shipping_address->s_lname ?? ''}}</strong><br>

              {{$shipping_address->s_address ?? ''}}

              @if($shipping_address->s_address2)
                <br>
                {{$shipping_address->s_address2 ?? ''}}
              @endif

              , {{$shipping_address->s_city ?? ''}},  {{$shipping_address->s_zipcode ?? ''}}

              <br>

              {{$shipping_address->s_phone ?? ''}}<br>

              {{$shipping_address->s_email ?? ''}}
            </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{{$order->invoice_id}}</b><br>
        <br>
        <b>Order ID:</b> FS-{{$order->id}}<br>

        @if($order->transaction_id)
        <b>Transaction ID:</b> {{$order->transaction_id}}
        @endif

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product</th>
              <th>Color</th>
              <th>Unit</th>
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

                @if($details->color)
                  {{$details->color}}
                @else
                  -
                @endif
              </td>
              <td>


                @if($details->unit)
                  {{$details->unit}}
                @else
                  -
                @endif

              </td>
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
        <!-- /.col -->
      </div>
    <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
          <p class="lead">Payment Methods:</p>

          <h3><strong>{{ $order->payment_method }}</strong></h3>


        </div>
        <!-- /.col -->
        <div class="col-6">
         <p class="lead"></p>
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>৳ {{$toal_p_price ?? ''}} BDT</td>
              </tr>

              <tr>
                <th>Shipping:</th>
                <td>

                    ৳ {{$site_info->shipping_charge ?? ''}} BDT

                </td>
              </tr>

              <tr>
                <th>Tax:</th>
                <td>

                    ৳ {{$site_info->tax ?? ''}} BDT

                </td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>৳ {{ $site_info->shipping_charge + $toal_p_price + $site_info->tax }} BDT</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
</body>
</html>
