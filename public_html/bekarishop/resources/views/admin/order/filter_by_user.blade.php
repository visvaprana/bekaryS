@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filter Order By User</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin/filter-order-by-user')}}" method="get">
                                @csrf
                                <div class="row mb-5">
                                    <div class="col-xl-2 col-md-2">
                                        <label class="col-form-label"><b> From </b></label>
                                        <input type="date" class="form-control" name="from_date">
                                    </div>
                                    <div class="col-xl-2 col-md-2">
                                        <label class="col-form-label"><b> TO </b></label>
                                        <input type="date" class="form-control" name="to_date">
                                    </div>

                                    @if($admin->role_id == 1)
                                        <div class="col-xl-2 col-md-2">
                                            <label class="col-form-label"><b> Seller </b></label>
                                            <select class="form-control" name="seller_id">
                                                <option value="">----Select----</option>
                                                @foreach($admins as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="col-xl-3 col-md-3">
                                        <label class="col-form-label"><b> User </b></label>
                                        <select class="form-control selectric" name="user_id" required>
                                            <option value="">----Select----</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} ({{$user->}})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-2 col-md-2">
                                        <label class="col-form-label"><p></p></label><br>
                                        <input type="submit" class="btn btn-success" value="Filter">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
