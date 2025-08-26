@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Booking</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Booked By</th>
                  <th>Date</th>
                  <th>Start Time - End Time</th>
                  <th>Duration</th>
                  <th>People</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @php $i=1 @endphp
            @foreach($bookings as $booking)
                <tr>

                  	<td>{{$i++}}</td>
                    <td>{{$booking->full_name}}</td>
                    <td> <?php echo date('d-m-Y', strtotime($booking->booking_date)); ?></td>
                    <td>
                       
                        <?php
                            $currentTime = $booking->start_time;
                            echo $newDateTime = date('h:i A', strtotime($currentTime));
                        ?>
                        -
                        <?php
                            $endTime = $booking->end_time;
                            echo $newEndTime = date('h:i A', strtotime($endTime));
                        ?>
                      
                    </td>
                    <td>{{$booking->duration}} days</td>
                    <td>{{$booking->people}} peoples</td>

	                <td>
	                    @php
	                        if($booking->status == 0){
	                           echo  "<div class='badge badge-warning badge-shadow'>Pending</div>";
	                         }
                           if($booking->status == 2){
	                           echo  "<div class='badge badge-info badge-shadow'>Approved</div>";
	                         }
                           
	                    @endphp
                      
	                </td>
                  	<td>

                      <div class="row">
                        <!-- <a href="{{URL::to('admin/booking/'.$booking->id)}}" title="View" style="float: left;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>
                            </button>
                        </a>   -->                      

                        <a href="{{URL::to('admin/booking/'.$booking->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                            </button>
                        </a>

                        <form action="{{URL::to('admin/booking/'.$booking->id)}}" method="post">
                        	@csrf
                        	@method('DELETE')
                        	<button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                      </div>


                  	</td>
                </tr>
				@endforeach
	
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