@extends('frontend.layouts.app')
@section('content')

    <link rel="stylesheet" href="{{asset('assets/backend/dist/css/')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend/dist/css/')}}/pos_invoice.css">
    <main>
        <div class="hero_single inner_pages background-image" data-background="url({{ asset('assets/frontend/') }}/img/hero_menu.jpg)">
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1>My Account</h1>
                            <p>Order food with home delivery or take away</p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->

        <!-- /filters_full -->

        <div class="page-content pt-150 pb-150 margin_60_40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">




<main id="content" role="main" class="main pointer-event"> 

    <div class="content container-fluid initial-38">

        <div class="row justify-content-center" id="printableArea">
        <div class="col-md-12">




        <hr class="non-printable">




        <div class="initial-38-1" style="max-width:382px; background: white;padding: 10px;">

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
        <span class="font-light">
          <?php echo date('d M Y h:i A', strtotime($order->created_at)); ?>

         
        </h5>
        </div>
        <div class="col-12">
        <h5>
        Customer Name :
        <span class="font-light">
        {{$user->fname ?? ''}} {{ $user->lname ?? ''}}
        </span>
        </h5>
        <h5>
        Phone :
        <span class="font-light">
         {{$user->phone ?? ''}}
        </span>
        </h5>
        <h5 class="text-break">
        Address :
        <span class="font-light">
        {{$user->address ?? ''}}, {{$user->city ?? ''}}  {{ $user->postcode ?? ''}}
        </span>
        </h5>
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

            <tr>
              <td class=""> {{$details->qty}} </td>
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
         ৳ {{$site_info->tax ?? '0'}} BDT</dd>
       
        <dt class="col-6 text-left">Delivery Fee:</dt>
        <dd class="col-6">
         ৳ {{$order->shipping_charge ?? ''}} BDT
        <hr>
        </dd>
        <dt class="col-6 text-left fz-20px">Total:</dt>
        <dd class="col-6 fz-20px">
        ৳ {{ $total_cost }} BDT
        </dd>
        </dl>
        </div>
        </div>
        <div class="d-flex flex-row justify-content-between border-top pt-3">
          <span class="text-capitalize">Paid by: {{ $order->payment_method }}</span>

          @if($order->transaction_id)
          <span class="text-capitalize">Transaction ID- {{$order->transaction_id}}</span>
          @endif
        </div>






        
        <span class="initial-38-7">-------------------------------------------------------------------</span>
        <h5 class="text-center pt-1">
        <span class="d-block">"""THANK YOU"""</span>
        </h5>
        <span class="initial-38-7">-------------------------------------------------------------------</span>
        <span class="d-block text-center">© <?php echo date('Y') ?> {{$site_info->site_name}}. All rights reserved.</span>
        </div>
        </div>
        </div>
        </div>


</main>



                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- /filters -->




        <div class="container margin_60_40">


            <!-- /row -->
        </div>
        <!-- /container -->

    </main>
    <!-- /main -->

@stop