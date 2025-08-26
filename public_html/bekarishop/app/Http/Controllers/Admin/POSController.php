<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Siteinfo;
use App\Models\User;
use App\Models\City;
use App\Models\Area;
use App\Models\Order;
use App\Models\SiteImage;
use App\Models\OrderDetail;
use App\Models\Admin;
use App\Models\PaymentMethod;
use DB;
use Cart;
use Hash;
use Auth;
use Session;
use App\Models\Coupon;

class POSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $users = User::orderBy('id', 'desc')->get();

        $categories = Category::where('status', 1)->get();


        $products = Product::orderBy('serial', 'asc')->paginate(81);

        $payment_methods = PaymentMethod::where('status', 1)->get();




        $contents = Cart::content();

        $sub_total = 0;
        $total_item = 0;
        if(count($contents) > 0){

            $sub_total = (float) str_replace(',', '', Cart::subtotal());


            $total_item = Cart::content()->count();
        }


        $siteinfo  = Siteinfo::first();

        $cities = City::all();

        return view("admin.pos.index", compact("categories", 'products', 'contents', 'sub_total', 'total_item', 'siteinfo', 'users', 'cities', 'payment_methods'));
    }

    public function print_order_report(Request $request){

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $seller_id = $request->seller_id;
        $invoice_id = $request->invoice_id;
        $payment_method = $request->payment_method;

        $seller = Admin::find($seller_id);


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
                if (!empty($seller_id) || $seller_id != '') {
                    $filter->where('admin_id', $seller_id);
                }
                if (!empty($invoice_id) || $invoice_id != '') {
                    $filter->where('invoice_id', $invoice_id);
                }
                if (!empty($payment_method) || $payment_method != '') {
                    $filter->where('payment_method_id', $payment_method);
                }
            })
            ->get();

        }else{
            $orders = Order::where(function($filter) use ($from_date, $to_date, $seller_id, $invoice_id, $payment_method) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('created_at', '<=' , $to_date);
                }
                if (!empty($seller_id) || $seller_id != '') {
                    $filter->where('admin_id', $seller_id);
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

        }



        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();


        return view('admin.order.print_order_report',compact('orders','from_date', 'to_date', 'seller_id', 'site_image', 'site_info', 'seller', 'invoice_id', 'payment_method'));

    }



    public function print_order_report_category(Request $request){

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $seller_id = $request->seller_id;
        $category_id = $request->category_id;

        $category = Category::where('id', $category_id)->first();

        $seller = Admin::find($seller_id);


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




        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();


        return view('admin.order.print_order_report_category',compact('orders','from_date', 'to_date', 'seller_id', 'site_image', 'site_info', 'seller', 'category'));

    }

    public function add_new_user(Request $request){

        $city = City::where('id', $request->city_id)->first();
        $area = Area::where('id', $request->area_id)->first();

        $data = new User();
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->postcode = $city->postcode;
        $data->city = $city->name;
        $data->area = $area->name;
        $data->password = Hash::make('123456');
        $data->password_str = '123456';
        $data->save();

        $notification=array(
            'message' => 'Customer Added Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function submit_order_admin(Request $request){


        $adminId = Session::get('adminId');
        $invoice_id =  rand(10000,100000);

        $product_id = $request->product_id;
        $quantity = $request->quantity;


        $discount =  $request->discount ?? 0;
        $shipping_charge = 0;
        $urgent_charge = 0;
        $area = '';
        $coupone_code = '';


        $total_qty =0;
        $total_cost = $request->total;
        $pay = $request->pay;
        if($pay == 0){
            return redirect()->back();
        }

        $return = $request->return;

        foreach ($quantity as $key => $value) {
            $total_qty = $total_qty + $value;

            // $product = Product::find($product_id[$key]);
            // $total_cost = $total_cost + $product->sell_price * $value;

        }

        $order = new Order();
        $order->admin_id = $adminId;
        $order->customer_id = $request->user_id;
        $order->payment_method_id = $request->payment_method_id;
        $order->invoice_id = $invoice_id;
        $order->billing_address_id = 0;
        $order->shipping_address_id = 0;
        $order->total_qty = $total_qty;

        $order->discount = $discount;
        $order->coupone_code = $coupone_code ?? '';

        if($area){
            $order->shipping_charge = $shipping_charge;

            if($discount){
                $order->total_cost = ($total_cost - $discount) + $shipping_charge + $urgent_charge;
            }else{
                $order->total_cost = $total_cost + $shipping_charge + $urgent_charge;
            }

        }else{
            $order->total_cost = $total_cost;
        }

        $order->pay_amount = $pay;
        $order->return_amount = $return;

        $order->payment_method = $request->payment_method ?? '';
        $order->transaction_id = $request->transaction_id ?? '';
        $order->isUrgent = 0;
        $order->urgent_charge = $urgent_charge;
        $order->status = 3;
        $order->save();


        $order_id = $order->id;

        $qty = $request->quantity;

 foreach ($product_id as $key => $value) {
    $product = Product::find($value);
    if ($product) {
        $category = ProductCategory::where('product_id', $product->id)->first();

        // Reduce product stock
        $product->qty = $product->qty - $qty[$key];

        // Update total_sell count
        $product->total_sell = ($product->total_sell ?? 0) + $qty[$key];

        $product->save();
    }

    $orderDetails = new OrderDetail();
    $orderDetails->order_id = $order_id;
    $orderDetails->product_id = $value;
    $orderDetails->category_id = $category->category_id ?? '0';
    $orderDetails->product_price = $product->sell_price;
    $orderDetails->qty_total_amount = $product->sell_price * $qty[$key];
    $orderDetails->color = '';
    $orderDetails->unit = '';
    $orderDetails->size = '';
    $orderDetails->qty = $qty[$key];
    $orderDetails->save();
}


        Cart::destroy();

        Session::forget('coupone_code');
        Session::forget('discount');
        Session::forget('coupon_percentage');

        return redirect('/admin/invoice/'.$order->id);

        // return redirect()->back();



    }

    public function applyCoupon(Request $request)
    {
        $couponCode = $request->coupon_code;


        // Check if coupon exists and is valid
        $coupon = Coupon::where('code', $couponCode)
            ->where('status', 1)
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code'
            ]);
        }

        // Check if coupon is expired
        if ($coupon->expiry_date && now()->gt($coupon->expiry_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon has expired'
            ]);
        }

        // Calculate discount
        $subTotal = (float) str_replace(',', '', Cart::subtotal());
        $discountAmount = 0;

        if ($coupon->type == 'percentage') {
            $discountAmount = ($subTotal * $coupon->value) / 100;
            $discountValue = $coupon->value . '%';
        } else {
            $discountAmount = $coupon->value;
            $discountValue = '৳' . number_format($coupon->value, 2);
        }

        // Store in session
        Session::put('coupone_code', $couponCode);
        Session::put('discount', $discountAmount);
        Session::put('coupon_percentage', $coupon->type == 'percentage' ? $coupon->value : null);

        return response()->json([
            'success' => true,
            'discount_amount' => $discountAmount,
            'discount_value' => $discountValue,
            'message' => 'Coupon applied successfully'
        ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }


    public function get_products(Request $request){


        if($request->category_id){
            $products = DB::table('products')
            ->join('product_categories', 'product_categories.product_id', '=', 'products.id')
            ->select('product_categories.product_id', 'product_categories.category_id', 'products.name', 'products.status', 'products.image', 'products.sell_price', 'products.id', 'products.serial')
            ->where('product_categories.category_id', $request->category_id)
            ->where('products.status', 1)
            ->orderBy('products.serial', 'asc')
            ->get();

        }else{
            $products = Product::where('status', 1)->get();
        }


        return view('admin.pos.get_products', compact('products'));
    }

    public function get_products_by_name(Request $request){


        $products = Product::where('name', 'LIKE', '%'.$request->product_name.'%')
        ->where('status', 1)
        ->get();

        return view('admin.pos.get_products', compact('products'));
    }

    public function add_to_cart(Request $request){

        $product_id = $request->product_id;


        $quantity = $request->quantity;

        $product = Product::find($product_id);

        $data = array();
        $data['id']=$product->id;
        $data['name']=$product->name;

        if($product->discount_price > 0){
            $data['price']=$product->discount_price;
        }else{
            $data['price']=$product->sell_price;
        }



        $data['qty']= $quantity ?? 1;
        $data['weight']=$product->id;
        $data['options']['image']=$product->product_image_thumb;
        $data['options']['color']=$request->color ?? '';
        $data['options']['size']=$request->size ?? '';
        $data['options']['unit']=$request->unit ?? '';
        $data['options']['slug']=$product->slug;

        $cart = Cart::add($data);
        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();

        $contents = Cart::content();

        $payment_methods = PaymentMethod::where('status', 1)->get();

        return view('admin.pos.add_to_cart', compact('sub_total', 'total_item', 'contents', 'payment_methods'));

        // return response()->json([
        //     'sub_total' => $sub_total,
        //     'total_item' => $total_item,
        //     'contents' => $contents,
        // ]);



    }

    public function remove_from_cart($rowId){

        Cart::remove($rowId);


        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();

        return redirect()->back();

        return response()->json([
            'sub_total' => $sub_total,
            'total_item' => $total_item
        ]);


        // $contents = Cart::content();

        // $sub_total = (float) str_replace(',', '', Cart::subtotal());
        // $total_item = Cart::content()->count();


        // return view('admin.pos.add_to_cart', compact('sub_total', 'total_item', 'contents', ));

    }
    public function update_cart(Request $request){

        $rowId = $request->rowId;

        $cart = Cart::get($rowId);

        $product = Product::find($cart->id);
        $qty = $request->qty;


        if($request->qty == "."){

            $qty = "0.1";
        }



        Cart::update($rowId, ['qty' => $qty]);

        $contents = Cart::content();
        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();


        return response()->json([
            'qty' => $qty,
            'sub_total' => $product->sell_price * $qty,
            'total' => $sub_total
        ]);

        return view('admin.pos.add_to_cart', compact('sub_total', 'total_item', 'contents', ));

    }

    public function clear_cart() {
        Cart::destroy();

        $notification=array(
            'message' => 'Cart cleared !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }



}
