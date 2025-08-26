
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
                                <h3 class="card-title">Update Menu</h3>
                                <a href="{{route('category.index')}}" class="btn btn-success"> + Add New </a>
                              </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <form action="{{route('category.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                                    @method('patch')
                                    @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Menu Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Menu Name" value="{{$data->name}}">
                                    </div>
                                    
                                    <!-- <div class="form-group">
                                        <label for="exampleInputEmail1">Parent Category</label>
                                        <select name="parent_id" id="" class="form-control">
                                            <option value="" selected="" disabled="">Select</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" @php echo $data->parent_id==$category->id?"selected":""; @endphp>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div> -->

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="description" class="form-control" rows="5">{!! $data->description !!}</textarea>
                                        </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Image</label>
                                        @if(isset($data))
                                        <div class="form-group">
                                            <img src="{{ asset($data->image) }}" alt="{{$data->title}}" style="width: 40%; margin-top: 8px">
                                            <input type="hidden" name="old_image" value="{{ $data->image }}">
                                        </div>
                                        @endif
                                        <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    
                                    <!-- <div class="form-group mt-5">
                                        <label for="exampleInputEmail1"><span class="text-danger">Category SEO</span></label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control" id="exampleInputEmail1" placeholder="Meta Title" value="{{$data->meta_title}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description</label>
                                        <input type="text" name="meta_des" class="form-control" id="exampleInputEmail1" placeholder="Meta Description" value="{{$data->meta_des}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control" id="exampleInputEmail1" placeholder="Meta Keywords" value="{{$data->meta_keywords}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Image</label>
                                        @if(isset($data))
                                        <div class="form-group">
                                            <img src="{{ asset($data->meta_image) }}" alt="{{$data->meta_title}}" style="width: 40%; margin-top: 8px">
                                            <input type="hidden" name="old_meta_image" value="{{ $data->meta_image }}">
                                        </div>
                                        @endif
                                        <input type="file" name="meta_image" class="form-control" id="exampleInputEmail1">
                                    </div> -->


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label> Status</label>
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