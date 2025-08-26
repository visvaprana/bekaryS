
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
                                <a href="{{route('area.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('area.update',$data->id)}}" method="post">
                                    @method('patch')
                                    @csrf
	                                <div class="card-body">


	                                    <div class="form-group">
	                                        <label for="exampleInputEmail1">Country<span style="color: red">*</span></label>

						                    <select name="country_id" id="country_id" class="form-control" required="" onchange="GetCity(this.value)">
					                    		@foreach($countries as $country)
						                      	<option value="{{$country->id}}" @php echo $data->country_id==$country->id?"selected":""; @endphp>{{$country->name}}</option>
					                      		@endforeach
						                    </select>

	                                    </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">City<span style="color: red">*</span></label>
                                            
                                            <select name="city_id" id="city_id" class="form-control" required="">
                                                <option value="" disabled="" selected="">Select</option>
                                                @foreach($cities as $city)
                                                <option value="{{$city->id}}" @php echo $data->city_id==$city->id?"selected":""; @endphp>{{$city->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>


	                                    <div class="form-group">
	                                        <label for="exampleInputEmail1">Area Name<span style="color: red">*</span></label>
	                                        <input type="text" name="name" value="{{$data->name}}" class="form-control" id="exampleInputEmail1" >
	                                    </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Postcode<span style="color: red">*</span></label>
                                            <input type="text" name="postcode" value="{{$data->postcode}}" class="form-control" id="exampleInputEmail1" required="">
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Shipping Charge<span style="color: red">*</span></label>
                                            <input type="text" name="shipping_charge" value="{{$data->shipping_charge}}" class="form-control" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Urgent Charge<span style="color: red">*</span></label>
                                            <input type="text" name="urgent_charge" value="{{$data->urgent_charge}}" class="form-control" required="">
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
