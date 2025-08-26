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

<div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Orders tracking</h3>
        </div>
        <div class="card-body contact-from-area">
            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
            <div class="row">
                <div class="col-lg-8">
                    <form class="contact-form-style mt-30 mb-50" action="{{route('track-order')}}" method="post">
                        @csrf
                        <div class="input-style mb-20">
                            <label>Invoice ID</label>
                            <input name="invoice_id" placeholder="Invoice ID of your order" type="text">
                        </div>
                        
                        <button type="submit" class="submit submit-auto-width" type="submit">Track</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>