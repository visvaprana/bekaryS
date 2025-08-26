@extends('admin.layouts.app')

@section('content')





<style>
	
.note-editor.note-frame .note-editing-area .note-editable {
    height: 300px;
}

</style>
<div class="content-wrapper">
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          	<div class="col-md-12 mt-5">

		            @if ($errors->any())
		                <div class="alert alert-danger">
		                    <ul>
		                        @foreach ($errors->all() as $error)
		                            <li>{{ $error }}</li>
		                        @endforeach
		                    </ul>
		                </div>
		            @endif
          		
	            <!-- Horizontal Form -->
		            <div class="card card-info">
		              <div class="card-header">
		                <h3 class="card-title">Edit contact request</h3>
		              </div>
		              <!-- /.card-header -->
		              <!-- form start -->
		              <form class="form-horizontal" action="{{URL::to('admin/update-contact-request/'.$data->id)}}" method="post">
		              	@csrf
	
		                <div class="card-body">



		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Name</label>
		                    <div class="col-sm-9">
		                      <input type="text" class="form-control" name="name" placeholder="Name" value="{{$data->name}}">
		                    </div>
		                  </div>		                  


		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Phone</label>
		                    <div class="col-sm-9">
		                      <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$data->phone}}">
		                    </div>
		                  </div>		                  


		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Address</label>
		                    <div class="col-sm-9">
		                      <input type="text" class="form-control" name="address" placeholder="Address" value="{{$data->address}}">
		                    </div>
		                  </div>		                  


		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Type</label>
		                    <div class="col-sm-9">
		

                                    
                                    <select class="form-control" name="type" required="">
                                        <option value=""> Select </option>
                                        <option value="Marriage"  @php echo $data->type=="Marriage"?"selected":""; @endphp> Marriage </option>
                                        <option value="Birthday"  @php echo $data->type=="Birthday"?"selected":""; @endphp> Birthday </option>
                                        <option value="Inquiry"  @php echo $data->type=="Inquiry"?"selected":""; @endphp> Inquiry </option>
                                        <option value="Other"  @php echo $data->type=="Other"?"selected":""; @endphp> Other </option>
                                    </select>
               
                        
		                    </div>
		                  </div>		                  


		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Message</label>
		                    <div class="col-sm-9">
		
		                      
		                      <textarea class="form-control" name="message">{!! $data->message !!}</textarea>
		                    </div>
		                  </div>		                  

		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
		                    <div class="col-sm-9">
		                      <select name="status" id="" class="form-control">
	                    			<option value="Complete" @php echo $data->status=="Complete"?"selected":""; @endphp>Complete</option>
	                    			<option value="Pending" @php echo $data->status=="Pending"?"selected":""; @endphp>Pending</option>
		                      </select>
		                    </div>
		                  </div>	                  


		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                  <button type="submit" class="btn btn-info">Save</button>
		                  <button type="reset" class="btn btn-default float-right">Cancel</button>
		                </div>
		                <!-- /.card-footer -->
		              </form>
	            </div>
	            <!-- /.card -->
			</div>
		</div>
	</div>
</section>
</div>


@endsection