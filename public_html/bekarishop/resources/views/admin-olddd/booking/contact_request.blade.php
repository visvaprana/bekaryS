@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage contact request</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl.</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @php $i=1 @endphp
            @foreach($contacts as $item)
                <tr>

                  	<td>{{$i++}}</td>
                    <td>{{$item->type}}</td>
                   
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->message}}</td>
                    <td>{{$item->status}}</td>

	              
                  	<td>

                      <div class="row">

                        <a href="{{URL::to('admin/edit-contact-request', $item->id)}}" title="Edit" style="float: left;margin-right: 10px;">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                            </button>
                        </a>
                        
                        
                        <a href="{{URL::to('admin/delete-contact-request', $item->id)}}" title="Delete" style="float: left;margin-right: 10px;">
                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                            </button>
                        </a>

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