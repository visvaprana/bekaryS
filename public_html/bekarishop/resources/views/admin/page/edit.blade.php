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
		                <h3 class="card-title">Add Page</h3>
		              </div>
		              <!-- /.card-header -->
		              <!-- form start -->
		              <form class="form-horizontal" action="{{URL::to('admin/page/'.$page->id)}}" method="post">
		              	@csrf
		              	@method('PATCH')
		                <div class="card-body">

		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Page Category</label>
		                    <div class="col-sm-9">
		                      <select name="page_category_id" id="" class="form-control">
		                    		@foreach($categories as $category)
		                      			<option value="{{$category->id}}"  @php echo $page->page_category_id==$category->id?"selected":""; @endphp>{{$category->name}}</option>
		                      		@endforeach
		                      </select>		                    	
		                    </div>
		                  </div>


		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label"> Title</label>
		                    <div class="col-sm-9">
		                      <input type="text" class="form-control" name="title" placeholder="Page Title" value="{{$page->title}}">
		                    </div>
		                  </div>		                  


		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
		                    <div class="col-sm-9">
				                <textarea name="content" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!$page->content!!}</textarea>
		                    </div>
		                  </div>			                  

		                  <div class="form-group row">
		                    <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
		                    <div class="col-sm-9">
		                      <select name="status" id="" class="form-control">
	                    			<option value="1" @php echo $page->status==1?"selected":""; @endphp>Active</option>
	                    			<option value="0" @php echo $page->status==0?"selected":""; @endphp>Inactive</option>
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