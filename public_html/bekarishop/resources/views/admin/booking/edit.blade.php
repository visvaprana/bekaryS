@extends('admin.layouts.app')

@section('content')



  <div class="content-wrapper">
    <section class="content mt-5">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <!-- general form elements -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('admin/update-shipping-address', [$booking->id])}}" method="post">
              	@csrf
                <div class="card-body">
	                  	
                  <div class="row">


                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Date</label>
                        <input name="booking_date" type="text" class="form-control" value="{{$booking->booking_date ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Start Time </label>
                        <input name="start_time" type="text" class="form-control" value="{{$booking->start_time ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >End Time </label>
                        <input name="end_time" type="text" class="form-control" value="{{$booking->end_time ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Duration </label>
                        <input name="duration" type="text" class="form-control" value="{{$booking->duration ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >People </label>
                        <input name="people" type="text" class="form-control" value="{{$booking->people ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >First Name</label>
                        <input name="fname" type="text" class="form-control" value="{{$user->fname ?? ''}}">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Last Name</label>
                        <input name="lname" type="text" class="form-control" value="{{$user->lname ?? ''}}">
                      </div>
                    </div>


                    <div class="col-md-4">
                      
                      <div class="form-group">
                        <label>Address </label>
                        <input type="text" class="form-control" name="address" value="{{$booking->address ?? ''}}">
                      </div>

                    </div>  

                    <div class="col-md-4">
                      <div class="form-group">
                        <label >City</label>
                        <input name="city" type="text" class="form-control" value="{{$user->city ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Area</label>
                        <input name="area" type="text" class="form-control" value="{{$user->area ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Post Code</label>
                        <input name="postcode" type="text" class="form-control" value=" {{$user->postcode ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Phone Number</label>
                        <input name="phone" type="text" class="form-control" value=" {{$booking->telephone ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label >Email</label>
                        <input name="email " type="text" class="form-control" value="{{$booking->email  ?? ''}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label >Message</label>
                        <textarea name="opt_message" id="" cols="30" rows="5" class="form-control">{{$booking->opt_message  ?? ''}}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-primary">Update</button> -->
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



@endsection