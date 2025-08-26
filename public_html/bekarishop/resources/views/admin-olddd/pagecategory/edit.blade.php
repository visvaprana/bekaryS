@extends('admin.layouts.app')

@section('content')

<div class="content-wrapper">
<section class="content">
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          	<div class="col-md-8 offset-2 mt-5">

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
		                <h3 class="card-title">Edit Page Category</h3>
		              </div>
		              <!-- /.card-header -->
		              <!-- form start -->
		              <form class="form-horizontal" action="{{URL::to('admin/pagecategory/'.$category->id)}}" method="post" enctype="multipart/form-data">

		              	@csrf
		              	@method('PATCH')
		                <div class="card-body">
		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label">Category Name</label>
		                    <div class="col-sm-9">
		                      <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{$category->name}}">
		                    </div>
		                  </div>		 



		                  <div class="form-group row">
		                    <label for="inputPassword3" class="col-sm-3 col-form-label">Status</label>
		                    <div class="col-sm-9">
		                      <select name="status" id="" class="form-control">
                        			<option value="1" @php echo $category->status==1?"selected":""; @endphp>Active</option>
                        			<option value="0" @php echo $category->status==0?"selected":""; @endphp>Inactive</option>
		                      </select>
		                    </div>
		                  </div>
		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                  <button type="submit" class="btn btn-info">Update</button>
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