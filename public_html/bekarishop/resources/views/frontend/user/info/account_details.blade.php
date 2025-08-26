<?php 
    $user_id = Session::get('user_id');
    $user = App\Models\User::where('id', $user_id)->first();
?>
    <style>
        .dashboard-menu ul li a {
            font-size: 16px;
            color: #7E7E7E;
            padding: 15px 30px;
            font-family: "Quicksand", sans-serif;
            font-weight: 700;
        }
        .dashboard-menu ul li {
            position: relative;
            border-radius: 10px;
            border: 1px solid #ececec;
            border-radius: 10px;
        }
        .dashboard-menu ul li:not(:last-child) {
            margin-bottom: 10px;
        }
        .dashboard-menu ul li a i {
            color: #7E7E7E;
            font-size: 19px;
            opacity: 0.6;
        }
        .dashboard-menu ul li a.active {
    color: #fff;
    background-color: #103178;
    border-radius: 10px;
}
.account .card {
    border: 0;
}
.account .card .card-header {
    border: 0;
    background: none;
}
.account .card .card-header h3{
    font-size: 30px;
    line-height: 40px;
    margin-bottom: 30px;
    color: #103178;
}
.account .card .table > thead {
    font-family: "Quicksand", sans-serif;
    font-size: 17px;
}
.account .card table td, .account .card table th {
    border: 0;
}
.account .card table th {
    font-weight: 600;
    font-family: "Quicksand", sans-serif;
}
.account .card table td{
    color: #9babcd;
}
.account a{
color: #103178;
}
.account input {
    border: 1px solid #ececec;
    border-radius: 10px;
    height: 64px;
    -webkit-box-shadow: none;
    box-shadow: none;
    padding-left: 20px;
    font-size: 16px;
    width: 100%;
}
.contact-from-area .contact-form-style button {
    font-size: 17px;
    font-weight: 500;
    padding: 20px 40px;
    color: #ffffff;
    border: none;
    background-color: #103178;
    border-radius: 10px;
    font-family: "Quicksand", sans-serif;
}
button.submit, button[type='submit'] {
    font-size: 16px;
    font-weight: 500;
    padding: 15px 40px;
    color: #ffffff;
    border: none;
    background-color: #103178;
    border: 1px solid #103178;
    border-radius: 10px;
}
.account label{
    color: #103178;
    font-size: 16px;
}
.account .card-header h5{
    font-size: 18px;
    line-height: 40px;
    margin-bottom: 30px;
    color: #103178;
}
.account .card-body  address{
    color: #9babcd;
}
.mar-top-page {
    padding: 6% 0% 10% 0%;
}
</style>
<div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
    <div class="card">
        <div class="card-header">
            <!-- <h5>Account Details</h5> -->
        </div>
        <div class="card-body">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li style="font-size: 12px">{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                @if (session()->has('notif'))
                    <div class="alert alert-success">
                        <strong style="font-size: 12px">{{ session()->get('notif') }}</strong>
                    </div>
                @endif

            
            <form action="{{route('update-profile')}}" method="post" name="enq">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>First Name <span class="required">*</span></label>
                        <input required="" class="form-control" name="fname" value="{{$user->fname}}" type="text" >
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name <span class="required">*</span></label>
                        <input required="" class="form-control" name="lname" value="{{$user->lname}}" >
                    </div>
                    <div class="form-group col-md-12">
                        <label>Email Address <span class="required">*</span></label>
                        <input required="" class="form-control" name="email" value="{{$user->email}}" type="email" >
                    </div>
                    <div class="form-group col-md-12">
                        <label>Phone Number <span class="required">*</span></label>
                        <input required="" class="form-control" name="phone" value="{{$user->phone}}" type="phone" >
                    </div>

                    <div class="form-group col-md-6">
                        <label>Area </label>
                        <select class="form-control" name="area_id" id="area_select2" onchange="GetShippingCharge(this.value)" required="">
                                <option selected>Select a Area...</option>
                            @foreach($areas as $area)
                                <option value="{{$area->id}}" @php if ($user['area'] == $area->name) { echo "selected"; } @endphp>{{$area->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Postal Code</label>
                        <input class="form-control zipcode" placeholder="0123" name="postcode" value="{{$user->postcode ?? ''}}">
                    </div>


                    <div class="form-group col-md-12">
                        <label>Address <span class="required">*</span></label>
                        <input class="form-control" name="address" value="{{$user->address}}" type="text" >
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label>New Password <span class="required">*</span></label>
                        <input class="form-control" name="password" type="password">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Confirm Password <span class="required">*</span></label>
                        <input class="form-control" name="password_confirmation" type="password">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>