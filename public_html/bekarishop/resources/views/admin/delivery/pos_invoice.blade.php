
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="0NnqewqwNUywmE954rRp1qTs4DHs9rtEwfVZhBFh">

    <title>Order Invoice</title>

    <link rel="shortcut icon" href="">

    <link rel="stylesheet" href="{{asset('assets/backend/dist/css/')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/dist/css/')}}/pos_invoice.css">
    </script>
</head>
<body class="">



<main id="content" role="main" class="main pointer-event">

    <div class="content container-fluid initial-38">

        <div class="row justify-content-center" id="printableArea">
        <div class="col-md-12">
        {{-- <center>
         <input type="button" class="btn btn-primary non-printable" onclick="printDiv('printableArea')" value="Print Now" />
        <a href="{{ url()->previous() }}" class="btn btn-danger non-printable">Back</a>
        </center> --}}
        <hr class="non-printable">




        <div class="initial-38-1" style="max-width:230px;">
        <!--<div class="initial-38-1">-->

         @if($site_image && $site_image->logo_black)
            <div class="pt-3" style="text-align: center;">
                <img src="{{ asset($site_image->logo_black) }}" class="initial-38-2" alt="" style="width: 155px;">
            </div>
        @endif


          <div class="text-center pt-2 mb-3 invoice-customer-address ">
            <h2 class="initial-38-3 site-name-invoice">{{$site_info->site_name}}</h2>
            <h5 class="text-break initial-38-4 site-name-invoice">
             {{$site_info->address}}
            </h5>
            <h5 class="initial-38-4 initial-38-3">
            Phone : {{$site_info->phone}}
            </h5>
          </div>

          <span class="initial-38-5">---------------------------------------------------------------------------------</span>

        <div class="row mt-3 invoice-customer-address">

          <div class="col-12 invoice-customer-address">
            <!--<h5>Order ID :-->
            <!--  <span class="font-light"> {{$order->invoice_id}} </span>-->
            <!--</h5>-->
            <p style="margin-bottom:0px" ><b>Order ID :</b>  <span class="font-light"> {{$order->invoice_id}} </span>  </p>
              <p style="margin-bottom:0px" ><b>Name :</b>  <span class="font-light"> {{ $order->user?->fname ?? '' }} {{ $order->user?->lname ?? '' }} </span>  </p>
              <p style="margin-bottom:0px" ><b>Phone :</b>  <span class="font-light"> {{$order->user?->phone}} </span>  </p>
              <p style="margin-bottom:0px" ><b>Address :</b>  <span class="font-light"> {{$order->user?->address}} </span>  </p>
          </div>

        <div class="col-12">
        <span class="font-light pos-font-w">
          <?php echo date('d M Y h:i A', strtotime($order->created_at)); ?>


        </h5>
        </div>
        <div class="col-12">
        {{-- <h5>
        Customer Name :
        <span class="font-light pos-font-w">
        {{$user->fname ?? ''}} {{ $user->lname ?? ''}}
        </span>
        </h5> --}}
        {{-- <h5>
        Phone :
        <span class="font-light">
         {{$user->phone ?? ''}}
        </span>
        </h5> --}}
        {{-- <h5 class="text-break">
        Address :
        <span class="font-light">
        {{$user->address ?? ''}}, {{$user->city ?? ''}}  {{ $user->postcode ?? ''}}
        </span>
        </h5> --}}
        </div>
        </div>
        <h5 class="text-uppercase"></h5>
        <span class="initial-38-5">---------------------------------------------------------------------------------</span>
        <table class="table table-bordered mt-1 mb-1">
        <thead>
        <tr>
        <th class="initial-38-6">QTY</th>
        <th class="initial-38-7">DESC</th>
        <th class="initial-38-7">Price</th>
        </tr>
        </thead>
        <tbody>

          @php $i=1; @endphp
          @foreach($orderDetails as $details)

          <?php
              $product = App\Models\Product::where('id', $details->product->id)->first();
              if($product){
                $product_unit = App\Models\ProductUnit::where('product_id', $product->id)->first();
              }
          ?>

            <tr>
              <td class="">

                {{$details->qty}} <br>
                {{ $product_unit->unit->name ?? '' }}

              </td>
              <td class="text-break">
               {{$details->product->name ?? ''}}
               <br>
                 <!--  <strong><u>Variation : </u></strong>

                  <span class="d-block text-capitalize">
                   <strong>Size -

                        @if($details->size)
                          {{$details->size}}
                        @else
                          -
                        @endif

                   </strong>
                  </span> -->

                  <span class="d-block text-capitalize">
                  &nbsp; &nbsp;
                    <strong>- ৳ {{$details->product_price ?? ''}}</strong>
                  </span>

              </td>
              <td class="w-28p">
              ৳ {{$details->qty_total_amount ?? ''}}
              </td>
            </tr>

          @endforeach

        </tbody>
        </table>
        <span class="initial-38-5">---------------------------------------------------------------------------------</span>
        <div class="mb-2 initial-38-9">
        <div class="">
        <dl class="row text-right">
        <dt class="col-6 text-left">Items Price:</dt>
        <dd class="col-6">৳ {{$toal_p_price ?? ''}} BDT</dd>


        <dt class="col-6 text-left">Discount:</dt>
        <dd class="col-6">
        - ৳ {{$order->discount ?? 0}} BDT
        </dd>

        <dt class="col-6 text-left">VAT/TAX:</dt>
        <dd class="col-6">+
         ৳ {{$site_info->tax ?? '0'}} BDT</dd>




        {{-- <dt class="col-6 text-left">Delivery Fee:</dt>
        <dd class="col-6">+
         ৳ {{$order->shipping_charge ?? ''}} BDT

        </dd>


        <dt class="col-6 text-left">Urgent Charge:</dt>
        <dd class="col-6">+
         ৳ {{$order->urgent_charge ?? '0'}} BDT
        <hr>
        </dd>
           --}}



        <dt class="col-4 text-left fz-20px">Total:</dt>
        <dd class="col-8 fz-20px">
        ৳ {{ $order->total_cost }} BDT
        </dd>


        <dt class="col-4 text-left fz-20px">Pay:</dt>
        <dd class="col-8 fz-20px">
        ৳ {{ $order->pay_amount }} BDT
        </dd>



        <dt class="col-4 text-left fz-20px">Return:</dt>
        <dd class="col-8 fz-20px">
        ৳ {{ $order->return_amount }} BDT
        </dd>

        </dl>
        </div>
        </div>
        <div class="d-flex flex-row justify-content-between border-top pt-3">
          <span class="text-capitalize">Paid by: {{ $order->payment_method_name() }}</span>

          @if($order->transaction_id)
          <span class="text-capitalize">Transaction ID- {{$order->transaction_id}}</span>
          @endif
        </div>
        <span class="initial-38-7">-------------------------------------------------------------------</span>
        <h5 class="text-center pt-1">
        <span class="d-block">"""HARE KRISHNA"""</span>
        </h5>
        <span class="initial-38-7">-------------------------------------------------------------------</span>
        <span class="d-block text-center">© <?php echo date('Y') ?> {{$site_info->site_name}}. All rights reserved.</span>
        </div>
        </div>
        </div>
        </div>


</main>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

        window.print();

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>



</body>
</html>
