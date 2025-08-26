@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->


<?php 
    $admin_id = Session::get("adminId");
    $admin = null;
    if($admin_id){
      $admin = App\Models\Admin::find($admin_id);
    }
    $payment_methods = App\Models\PaymentMethod::get();
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">


          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                    $date = date('Y-m-d');

                    if($admin->role_id == 1){
                        $today_sale = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->sum('total_cost');
                    }else {
                        $today_sale = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->where('admin_id', $admin_id)->sum('total_cost');
                    }
                    
                   
                ?>
                <h3>{{$today_sale}} TK</h3>

                <p>Today sale amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{URL::to('admin/order')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php 

                    if($admin->role_id == 1){
                      $total_sale = App\Models\Order::sum('total_cost');
                    }else {
                      $total_sale = App\Models\Order::where('admin_id', $admin_id)->sum('total_cost');
                    }

                  
                ?>
                <h3>{{$total_sale}} TK</h3>

                <p>Total sale amount</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{URL::to('admin/order')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                    $date = date('Y-m-d');


                    if($admin->role_id == 1){
                      $today_orders = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->count();
                    }else {
                      $today_orders = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->where('admin_id', $admin_id)->count();
                    }


                    
                ?>
                <h3>{{$today_orders}}</h3>

                <p>Today Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{URL::to('admin/order')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <?php 


                    if($admin->role_id == 1){
                      $total_orders = App\Models\Order::count();
                    }else {
                      $total_orders = App\Models\Order::where('admin_id', $admin_id)->count();
                    }


                  
                ?>
                <h3>{{$total_orders}}</h3>

                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{URL::to('admin/order')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                  $total_products = App\Models\Product::count();
                ?>

                <h3>{{$total_products}}</h3>

                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6"> </div>
          <div class="col-lg-3 col-6"> </div>
          <div class="col-lg-3 col-6"> </div>


          @foreach($payment_methods as $item)
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">


                <?php
                    $date = date('Y-m-d');

                    if($admin->role_id == 1){
                        $today_sale = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->where('payment_method_id', $item->id)->sum('total_cost');
                    }else {
                        $today_sale = App\Models\Order::where( 'created_at', 'LIKE', '%' . $date .'%')->where('payment_method_id', $item->id)->where('admin_id', $admin_id)->sum('total_cost');
                    }
                    
                   
                ?>

                <h3>{{$today_sale}}</h3>

                <p>{{$item->title}} - Today Sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endforeach


          @foreach($payment_methods as $item)
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">


                <?php

                    if($admin->role_id == 1){
                        $today_sale = App\Models\Order::where('payment_method_id', $item->id)->sum('total_cost');
                    }else {
                        $today_sale = App\Models\Order::where('payment_method_id', $item->id)->where('admin_id', $admin_id)->sum('total_cost');
                    }
                    
                   
                ?>

                <h3>{{$today_sale}}</h3>

                <p>{{$item->title}} - All Sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endforeach


          
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @stop