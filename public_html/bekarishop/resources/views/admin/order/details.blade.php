@extends('admin.layouts.app')

@section('content')


<link rel="stylesheet" href="{{asset('assets/backend/dist/css/')}}/pos_invoice.css">

<style>
    h5 {
        font-size: 13px;
    },


</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">







<main id="content" role="main" class="main pointer-event"  style="background: white;padding: 10px;">

    <div class="content container-fluid initial-38">

        <div class="row justify-content-center" id="printableArea">
        <div class="col-md-12">
        <center>
         <a href="{{ route('admin/invoice', $order->id) }}"> <input type="button" class="btn btn-primary non-printable"  value="Proceed, If thermal printer is ready." style="color: white;" /></a>
        <!--<a href="https://stackfood-admin.6amtech.com/admin/order/generate-invoice/100075" class="btn btn-danger non-printable">Back</a>-->
        </center>
        <hr class="non-printable">
        <div class="initial-38-1">
          <div class="pt-3" style="text-align: center;">
            <img src="{{asset($site_image->logo_black)}}" class="initial-38-2" alt="" style="width: 155px;">
          </div>

          <div class="text-center pt-2 mb-3">
            <h2 class="initial-38-3">{{$site_info->site_name}}</h2>
            <h5 class="text-break initial-38-4">
             {{$site_info->address}}
            </h5>
            <h5 class="initial-38-4 initial-38-3">
            Phone : {{$site_info->phone}}
            </h5>
          </div>

          <span class="initial-38-5">---------------------------------------------------------------------------------</span>

        <div class="row mt-3">

          <div class="col-6">
            <h5>Order ID :
              <span class="font-light"> {{$order->invoice_id}} </span>
            </h5>
          </div>

        <div class="col-6">
        <span class="font-light" style="font-size: 13px;">
          <?php echo date('d M Y h:i A', strtotime($order->created_at)); ?>


        </h5>
        </div>
        <div class="col-12">
        {{-- <h5>
        Customer Name :
        <span class="font-light">
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
        <div class="px-3">
        <dl class="row text-right">
        <dt class="col-6 text-left">Items Price:</dt>
        <dd class="col-6">৳ {{$toal_p_price ?? ''}} BDT</dd>


        <dt class="col-6 text-left">Discount:</dt>
        <dd class="col-6">
        - ৳ {{$order->discount ?? 0}} BDT
        </dd>

        <dt class="col-6 text-left">VAT/TAX:</dt>
        <dd class="col-6">+
         ৳ {{$site_info->tax ?? '0'}} BDT
         </dd>





        {{-- <dt class="col-6 text-left">Delivery Fee:</dt>
        <dd class="col-6">+
         ৳ {{$order->shipping_charge ?? ''}} BDT
        </dd>


        <dt class="col-4 text-left">Urgent Charge:</dt>
        <dd class="col-8">+
         ৳ {{$order->urgent_charge ?? '0'}} BDT
        <hr>
        </dd> --}}




        <dt class="col-6 text-left fz-20px">Total:</dt>
        <dd class="col-6 fz-20px">
        ৳ {{ $order->total_cost }} BDT
        </dd>

        <dt class="col-6 text-left fz-20px">Pay:</dt>
        <dd class="col-6 fz-20px">
        ৳ {{ $order->pay_amount }} BDT
        </dd>



        <dt class="col-6 text-left fz-20px">Return:</dt>
        <dd class="col-6 fz-20px">
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













          </div><!-- /.col -->




            {{-- <div class="col-md-4">


                <div style="background: #ebebeb; padding: 14px;">

                    <div class="">

                          <p style="font-size: 19px; font-weight: bold;">Shipping Address :</p>


                            <address>
                              <strong>{{$user->fname ?? ''}} {{ $user->lname ?? ''}}</strong><br>

                              {{$user->address ?? ''}}

                               {{$user->city ?? ''}}  {{ $user->postcode ?? ''}}

                              <br>

                              {{$user->phone ?? ''}}<br>

                              {{$user->email ?? ''}}
                            </address>


                    </div>

                </div>


                <hr>


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

            </div>
           --}}









        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>

  function printDiv(divName) {
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;

       window.print();

       document.body.innerHTML = originalContents;
  }

  </script>


@endsection
