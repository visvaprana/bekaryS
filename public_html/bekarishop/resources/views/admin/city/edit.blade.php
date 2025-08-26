
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-header" style="text-align: right">
                                <h3 class="card-title">Update City</h3>
                                <a href="{{route('city.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('city.update',$data->id)}}" method="post">
                                    @method('patch')
                                    @csrf
	                                <div class="card-body">


	                                    <div class="form-group">
	                                        <label for="exampleInputEmail1">Country<span style="color: red">*</span></label>

						                    <select name="country_id" id="" class="form-control" required="">
					                    		@foreach($countries as $country)
						                      	<option value="{{$country->id}}" @php echo $data->country_id==$country->id?"selected":""; @endphp>{{$country->name}}</option>
					                      		@endforeach
						                    </select>

	                                    </div>


	                                    <div class="form-group">
	                                        <label for="exampleInputEmail1">City Name<span style="color: red">*</span></label>
	                                        <input type="text" name="name" value="{{$data->name}}" class="form-control" id="exampleInputEmail1" >
	                                    </div>



	                                    <div class="row">
	                                        <div class="col-sm-12">
	                                            <!-- select -->
	                                            <div class="form-group">
	                                                <label>Publication Status</label>
	                                                <select class="custom-select" name="status">
	                                                    <option value="1" @php if ($data['status'] == 1) { echo "selected"; } @endphp>Active</option>
	                                                    <option value="0" @php if ($data['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
	                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
