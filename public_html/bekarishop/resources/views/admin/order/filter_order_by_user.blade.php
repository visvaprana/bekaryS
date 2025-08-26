@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders Filtered By Customer</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin/filter-order-by-user')}}" method="get">
                                @csrf
                                <div class="row mb-5">
                                    <div class="col-xl-2 col-md-2">
                                        <label class="col-form-label"><b> From </b></label>
                                        <input type="date" class="form-control" name="from_date" value="{{$from_date ?? ''}}">
                                    </div>
                                    <div class="col-xl-2 col-md-2">
                                        <label class="col-form-label"><b> TO </b></label>
                                        <input type="date" class="form-control" name="to_date" value="{{$to_date ?? ''}}">
                                    </div>

                                    @if($admin->role_id == 1)
                                        <div class="col-xl-2 col-md-2">
                                            <label class="col-form-label"><b> Seller </b></label>
                                            <select class="form-control" name="seller_id">
                                                <option value="">----Select----</option>
                                                @foreach($admins as $item)
                                                    <option value="{{$item->id}}" {{$seller_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="col-xl-3 col-md-3">
                                        <label class="col-form-label"><b> Customer </b></label>
{{--                                        @dd($users)--}}
                                        <select class="form-control selectric" name="user_id" required>
                                            <option value="">----Select----</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{$user_id == $user->id ? 'selected' : ''}}>{{$user->fname}} {{$user->lname}} ({{@$user->email}})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-2 col-md-2">
                                        <label class="col-form-label"><p></p></label><br>
                                        <input type="submit" class="btn btn-success" value="Filter">
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Pay</th>
                                        <th>Return</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($orders as $item)
{{--                                        @dd($item->customer_id)--}}
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->invoice_id}}</td>
                                            <td>{{$item->created_at->format('d M Y')}}</td>
                                            <td>
                                                @php
                                                    $user = App\Models\User::find($item->customer_id);
                                                    $userName = $user ? ($user->fname . ' ' . $user->lname) : 'Customer Not Found';
                                                @endphp
                                                {{ $userName }}
                                            </td>
                                            <td>{{($item->total_cost ?? 0) - ($item->discount ?? 0)}}</td>
                                            <td>{{$item->pay_amount ?? 0}}</td>
                                            <td>{{$item->return_amount ?? 0}}</td>
                                            <td>
                                                @if($item->status == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($item->status == 1)
                                                    <span class="badge badge-info">Processing</span>
                                                @elseif($item->status == 2)
                                                    <span class="badge badge-primary">On The Way</span>
                                                @elseif($item->status == 3)
                                                    <span class="badge badge-success">Delivered</span>
                                                @else
                                                    <span class="badge badge-danger">Canceled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="{{route('order.show',$item->id)}}">Details</a>
                                                        <a class="dropdown-item" href="{{route('order.edit',$item->id)}}">Edit</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
