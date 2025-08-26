<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\ShippingAddress;
use App\Models\BillingAddress;
use App\Models\Siteinfo;
use App\Models\SiteImage;
use App\Models\Product;
use App\Models\DeliverymanToOrder;
use App\Models\User;
use App\Models\Employee;
use App\Models\Category;

use App\Models\ProductCategory;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);
        $admins = Admin::get();

        if($admin->role_id == '1'){
            $orders = Order::orderBy('id', 'desc')->paginate(50);
            
            $total_cost = Order::sum('total_cost');
            $total_pay = Order::sum('pay_amount');
            $total_return = Order::sum('return_amount');
            
        }else{
            $orders = Order::orderBy('id', 'desc')->where('admin_id', $admin_id)->paginate(50);
            
            $total_cost = Order::where('admin_id', $admin_id)->sum('total_cost');
            $total_pay = Order::where('admin_id', $admin_id)->sum('pay_amount');
            $total_return = Order::where('admin_id', $admin_id)->sum('return_amount');
            
            
        }

        $methods = PaymentMethod::get();
        $categories = Category::get();
        return view('admin.order.index', compact('orders', 'methods', 'admin', 'admins', 'categories', 'total_cost', 'total_pay', 'total_return'));
    }

    public function pending_order()
    {

        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);

        if($admin->role_id == '1'){
            $orders = Order::where('status', 0)->orderBy('id', 'desc')->get();
        }else{
            $orders = Order::where('status', 0)->orderBy('id', 'desc')->where('admin_id', $admin_id)->get();
        }

        $methods = PaymentMethod::get();
        return view('admin.order.pending_order', compact('orders', 'methods'));
    }

    public function processing_order()
    {
        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);

        if($admin->role_id == '1'){
            $orders = Order::where('status', 1)->orderBy('id', 'desc')->get();
        }else{
            $orders = Order::where('status', 1)->orderBy('id', 'desc')->where('admin_id', $admin_id)->get();
        }
        $methods = PaymentMethod::get();
        return view('admin.order.processing_order', compact('orders', 'methods'));
    }

    public function on_the_way_order()
    {
        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);

        if($admin->role_id == '1'){
            $orders = Order::where('status', 2)->orderBy('id', 'desc')->get();
        }else{
            $orders = Order::where('status', 2)->orderBy('id', 'desc')->where('admin_id', $admin_id)->get();
        }
        $methods = PaymentMethod::get();
        return view('admin.order.on_the_way_order', compact('orders', 'methods'));
    }

    public function delivered_order()
    {
        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);

        if($admin->role_id == '1'){
            $orders = Order::where('status', 3)->orderBy('id', 'desc')->get();
        }else{
            $orders = Order::where('status', 3)->orderBy('id', 'desc')->where('admin_id', $admin_id)->get();
        }
        $methods = PaymentMethod::get();
        return view('admin.order.delivered_order', compact('orders', 'methods'));
    }

    public function canceled_order()
    {
        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);

        if($admin->role_id == '1'){
            $orders = Order::where('status', 4)->orderBy('id', 'desc')->get();
        }else{
            $orders = Order::where('status', 4)->orderBy('id', 'desc')->where('admin_id', $admin_id)->get();
        }
        $methods = PaymentMethod::get();
        return view('admin.order.canceled_order', compact('orders', 'methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $order = Order::findorfail($id);
        $orderDetails = OrderDetail::where('order_id', $id)->get();
     
        $toal_p_price = OrderDetail::where('order_id', $id)->sum('qty_total_amount');

        $shipping_address = ShippingAddress::where('order_id', $id)->first();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();

        $total_cost = ($order->shipping_charge + $toal_p_price + $site_info->tax) - $order->discount + $order->urgent_charge;

        $user = User::where('id', $order->customer_id)->first();


        $already_assign = DeliverymanToOrder::where('order_id', $id)->first();
        if($already_assign){
            $delivery_man = Employee::where('id', $already_assign->employee_id)->first();
            
            return view('admin.order.details', compact('order', 'orderDetails', 'toal_p_price', 'shipping_address', 'site_info', 'site_image', 'total_cost', 'user', 'already_assign', 'delivery_man'));
            
        }else{
            return view('admin.order.details', compact('order', 'orderDetails', 'toal_p_price', 'shipping_address', 'site_info', 'site_image', 'total_cost', 'user'));
        }

        


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findorfail($id);
        $orderDetails = OrderDetail::where('order_id', $id)->get();

        $user = User::where('id', $order->customer_id)->first();

        $toal_p_price = OrderDetail::where('order_id', $id)->sum('qty_total_amount');
        $shipping_address = ShippingAddress::where('order_id', $id)->first();
        $billing_address = BillingAddress::where('customer_id', $order->customer_id)->first();

        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();


        $total_cost = ($order->shipping_charge + $toal_p_price + $site_info->tax) - $order->discount;

        return view('admin.order.edit', compact('order', 'orderDetails', 'toal_p_price', 'shipping_address', 'site_info', 'site_image', 'billing_address', 'total_cost', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findorfail($id);
        $order->delete();

        OrderDetail::where('order_id', $id)->delete();

        $notification=array(
            'message' => 'Delete Successful !!',
            'alert-type' => 'danger'
        );
        return redirect()->back()->with($notification);

    }

    public function invoice_print($id){

        $order = Order::findorfail($id);
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        $toal_p_price = OrderDetail::where('order_id', $id)->sum('qty_total_amount');
        $shipping_address = ShippingAddress::where('order_id', $id)->first();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        return view('admin.order.invoice_print', compact('order', 'orderDetails', 'toal_p_price', 'shipping_address', 'site_info', 'site_image'));
    }

    public function update_shipping_address(Request $request, $id){

        ShippingAddress::where('order_id', $id)->update(
            [
                's_fname' => $request->s_fname,
                's_lname' => $request->s_lname,
                's_email' => $request->s_email,
                's_phone' => $request->s_phone,
                's_address' => $request->s_address,
                's_address2' => $request->s_address2,
                's_zipcode' => $request->s_zipcode,
                's_city' => $request->s_city,
            ]

        );

        $notification=array(
            'message' => 'Shipping Address Updated Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function update_order_summery(Request $request, $id){

        $order_summery = Order::findorfail($id);
        if ($order_summery->status == 3) {
            $notification=array(
                'message' => 'Order Completed Already!',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        $order_summery->status = $request->status;
        $order_summery->save();

        if ($request->status == 3) {
            $product_id = $request->product_id;
            $product_sales_qty = $request->qty;
            foreach ($product_id as $key => $value) {
                $a = Product::where('id', $value)->first();

                $b = $product_sales_qty[$key];


                $available_stock = $a->qty-$b;
                
                $t_s = $a->total_sell;
                $total_sell = $t_s+$b;
                $total_product = $available_stock+$total_sell;
                $product_id = $value;

                $data = array();
                $data['qty'] = $available_stock;
                $data['total_sell'] = $total_sell;
                $data['total_product'] = $total_product;
                Product::where('id', $product_id)->update($data);


            }


        }


        $notification=array(
            'message' => 'Order Updated Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

   public function filter_order(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $payment_method = $request->payment_method;
  
        $status = $request->status;
        $seller_id = $request->seller_id;
        $invoice_id = $request->invoice_id;

   

        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);
        $admins = Admin::get();
        
  

        if($admin->role_id == 1){
            
            $orders = Order::where(function($filter) use ($from_date, $to_date, $seller_id, $invoice_id, $payment_method) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('created_at', '<=' , $to_date);
                }                       
            
                if (!empty($invoice_id) || $invoice_id != '') {
                    $filter->where('invoice_id', $invoice_id);
                }
                if (!empty($seller_id) || $seller_id != '') {
                    $filter->where('admin_id', $seller_id);
                }
                if (!empty($payment_method) || $payment_method != '') {
                    $filter->where('payment_method_id', $payment_method);
                }
            })
         ->get();
         
         
         
          $all_orders = Order::where(function($filter) use ($from_date, $to_date, $seller_id, $invoice_id, $payment_method) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('created_at', '<=' , $to_date);
                }                       
            
                if (!empty($invoice_id) || $invoice_id != '') {
                    $filter->where('invoice_id', $invoice_id);
                }
                if (!empty($seller_id) || $seller_id != '') {
                    $filter->where('admin_id', $seller_id);
                }
                if (!empty($payment_method) || $payment_method != '') {
                    $filter->where('payment_method_id', $payment_method);
                }
            })
         ->get();
         
         $total_cost = $all_orders->sum('total_cost');
         $total_pay = $all_orders->sum('pay_amount');
         $total_return = $all_orders->sum('return_amount');
         

         
        }else{

            $orders = Order::where(function($filter) use ($from_date, $to_date, $status, $invoice_id, $payment_method) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('created_at', '<=' , $to_date);
                }                       
                              
                if (!empty($status) || $status != '') {
                    $filter->where('status', $status);
                }
                if (!empty($invoice_id) || $invoice_id != '') {
                    $filter->where('invoice_id', $invoice_id);
                }
                 if (!empty($payment_method) || $payment_method != '') {
                    $filter->where('payment_method_id', $payment_method);
                }
               
            })
            ->where('admin_id', $admin_id)
            ->get();
            

            $all_orders = Order::where(function($filter) use ($from_date, $to_date, $status, $invoice_id, $payment_method) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('created_at', '<=' , $to_date);
                }                       
                              
                if (!empty($status) || $status != '') {
                    $filter->where('status', $status);
                }
                if (!empty($invoice_id) || $invoice_id != '') {
                    $filter->where('invoice_id', $invoice_id);
                }
                 if (!empty($payment_method) || $payment_method != '') {
                    $filter->where('payment_method_id', $payment_method);
                }
               
            })
            ->where('admin_id', $admin_id)
            ->get();
            
            
             $total_cost = $all_orders->sum('total_cost');
             $total_pay = $all_orders->sum('pay_amount');
             $total_return = $all_orders->sum('return_amount');

        }



        $methods = PaymentMethod::where('status', 1)->get();

        $today_date = date('Y-m-d');
        return view('admin.order.filter_order',compact('orders','from_date', 'to_date', 'payment_method', 'status', 'today_date', 'methods', 'admin', 'admins', 'seller_id', 'invoice_id', 'payment_method', 'total_cost', 'total_pay', 'total_return'));
   }
   
   public function filter_by_category(){
       
        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);
        $admins = Admin::get();

        $methods = PaymentMethod::get();
        $categories = Category::get();
        
        return view('admin.order.filter_by_category', compact('methods', 'admin', 'admins', 'categories'));
   }

   public function filter_order_by_category(Request $request){
       
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $seller_id = $request->seller_id;
        $category_id = $request->category_id;
        
      



        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);
        $admins = Admin::get();
        
  
  

  
  

        if($admin->role_id == 1){
            
            $orders = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')->select('order_details.*', 'orders.admin_id', 'orders.invoice_id')->where(function($filter) use ($from_date, $to_date, $seller_id, $category_id) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('order_details.created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('order_details.created_at', '<=' , $to_date);
                }                       
            
                if (!empty($category_id) || $category_id != '') {
                    $filter->where('order_details.category_id', $category_id);
                }
                
                if (!empty($seller_id) || $seller_id != '') {
                    $filter->where('orders.admin_id', $seller_id);
                }
            })
         ->get();
         
            // dd($orders->sum('qty_total_amount'));
         
        }else{

            $orders = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')->select('order_details.*', 'orders.admin_id', 'orders.invoice_id')->where(function($filter) use ($from_date, $to_date, $category_id) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('order_details.created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('order_details.created_at', '<=' , $to_date);
                }                       

                if (!empty($category_id) || $category_id != '') {
                    $filter->where('order_details.category_id', $category_id);
                }                   
                              
             
               
            })
            ->where('orders.admin_id', $admin_id)
            ->get();

        }



        $methods = PaymentMethod::where('status', 1)->get();
        $categories = Category::get();

        $today_date = date('Y-m-d');
        return view('admin.order.filter_order_by_category',compact('orders','from_date', 'to_date', 'methods', 'today_date', 'methods', 'admin', 'admins', 'seller_id', 'category_id', 'categories'));
   }
   
       public function filter_by_user(){
        $admin_id = Session::get("adminId");
        $admin = Admin::find($admin_id);
        $admins = Admin::get();

        $methods = PaymentMethod::get();
        $users = User::get(); // Get all users for the filter dropdown

        return view('admin.order.filter_by_user', compact('methods', 'admin', 'admins', 'users'));
    }

   public function filter_order_by_user(Request $request)
{
    $from_date = $request->from_date;
    $to_date = $request->to_date;
    $seller_id = $request->seller_id;
    $user_id = $request->user_id;

    $admin_id = Session::get("adminId");
    $admin = Admin::find($admin_id);
    $admins = Admin::get();
    $users = User::get();

    if ($admin->role_id == 1) {
        $orders = Order::where(function($filter) use ($from_date, $to_date, $seller_id, $user_id) {
                if (!empty($from_date)) {
                    $filter->where('created_at', '>=', $from_date);
                }
                if (!empty($to_date)) {
                    $filter->where('created_at', '<=', $to_date);
                }
                if (!empty($user_id)) {
                    $filter->where('customer_id', $user_id);
                }
                if (!empty($seller_id)) {
                    $filter->where('admin_id', $seller_id);
                }
            })
            ->orderBy('created_at', 'desc') // 🔽 latest first
            ->get();

        $all_orders = Order::where(function($filter) use ($from_date, $to_date, $seller_id, $user_id) {
                if (!empty($from_date)) {
                    $filter->where('created_at', '>=', $from_date);
                }
                if (!empty($to_date)) {
                    $filter->where('created_at', '<=', $to_date);
                }
                if (!empty($user_id)) {
                    $filter->where('customer_id', $user_id);
                }
                if (!empty($seller_id)) {
                    $filter->where('admin_id', $seller_id);
                }
            })
            ->get();

        $total_cost = $all_orders->sum('total_cost');
        $total_pay = $all_orders->sum('pay_amount');
        $total_return = $all_orders->sum('return_amount');
    } else {
        $orders = Order::where(function($filter) use ($from_date, $to_date, $user_id) {
                if (!empty($from_date)) {
                    $filter->where('created_at', '>=', $from_date);
                }
                if (!empty($to_date)) {
                    $filter->where('created_at', '<=', $to_date);
                }
                if (!empty($user_id)) {
                    $filter->where('customer_id', $user_id);
                }
            })
            ->where('admin_id', $admin_id)
            ->orderBy('created_at', 'desc') // 🔽 latest first
            ->get();

        $all_orders = Order::where(function($filter) use ($from_date, $to_date, $user_id) {
                if (!empty($from_date)) {
                    $filter->where('created_at', '>=', $from_date);
                }
                if (!empty($to_date)) {
                    $filter->where('created_at', '<=', $to_date);
                }
                if (!empty($user_id)) {
                    $filter->where('customer_id', $user_id);
                }
            })
            ->where('admin_id', $admin_id)
            ->get();

        $total_cost = $all_orders->sum('total_cost');
        $total_pay = $all_orders->sum('pay_amount');
        $total_return = $all_orders->sum('return_amount');
    }

    $methods = PaymentMethod::where('status', 1)->get();

    $today_date = date('Y-m-d');
    return view('admin.order.filter_order_by_user', compact(
        'orders',
        'from_date',
        'to_date',
        'methods',
        'today_date',
        'admin',
        'admins',
        'seller_id',
        'user_id',
        'users',
        'total_cost',
        'total_pay',
        'total_return'
    ));
}

    
   
   public function update_category_id(){
       
       
        $datas = Product::get();
        
        foreach($datas as $item){
            if($item){
                $category = ProductCategory::where('product_id', $item->id)->first();
            }
            OrderDetail::where('product_id', $item->id)->update([
                'category_id' => $category->category_id
            ]);
        }
        
        return "Done";
          
          
   }



}
