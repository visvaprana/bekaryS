
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
                                <a href="{{route('item.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('item.update',$data->id)}}" method="post" enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
	                                <div class="card-body">


	                                    <!-- <div class="form-group">
	                                        <label for="exampleInputEmail1">Country<span style="color: red">*</span></label>

						                    <select name="resturant_id" id="" class="form-control" >

                                                @foreach($resturants as $resturant)
                                                <option value="{{$resturant->id}}" @php echo $data->resturant_id==$resturant->id?"selected":""; @endphp>{{$resturant->name}}</option>
                                                @endforeach

						                    </select>

	                                    </div> -->


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Item Name</label>
                                            <input type="text" name="name" class="form-control" value="{{$data->name}}" id="exampleInputEmail1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="description" class="form-control" rows="5">{!! $data->description !!}</textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Item Image</label>


                                            @if(isset($data))
                                            <div class="form-group">
                                                <img src="{{ asset($data->image) }}" alt="Image" style="width: 20%; margin-top: 8px">
                                                <input type="hidden" name="old_image" value="{{ $data->image }}">
                                            </div>
                                            @endif

                                            <input type="file" name="image" class="form-control" id="exampleInputEmail1">
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
