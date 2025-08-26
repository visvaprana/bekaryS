
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
                                <h3 class="card-title">Update Banner</h3>
                                <a href="{{route('banner.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('banner.update',$data->id)}}" method="post" enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Banner Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Banner Title" value="{{$data->title}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Subscribe Title</label>
                                        <input type="text" name="subscribe_title" class="form-control" id="exampleInputEmail1" placeholder="Subscribe Title" value="{{$data->subscribe_title}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Image</label>

                                            @if(isset($data))
                                            <div class="form-group">
                                                <img src="{{ asset($data->image) }}" alt="Image" style="width: 40%; margin-top: 8px">
                                                <input type="hidden" name="old_image" value="{{ $data->image }}">
                                            </div>
                                            @endif

                                        <input type="file" name="image" class="form-control" id="exampleInputEmail1" >
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Url</label>
                                        <input type="text" name="url" value="{{$data->url}}"  class="form-control" id="exampleInputEmail1">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Button Txt</label>
                                        <input type="text" name="btn_txt" value="{{$data->btn_txt}}"  class="form-control" id="exampleInputEmail1">
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
