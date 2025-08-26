<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\BillingAddress;
use App\Models\ShippingAddress;
use App\Models\Wishlist;
use App\Models\PaymentMethod;
use App\Models\Coupon;
use App\Models\Siteinfo;
use App\Models\City;
use App\Models\Area;
use App\Models\SiteImage;
use Auth;
use Session;
use DB;
use Cart;
use Str;
use Hash;

class ShopController extends Controller
{


    public function add_to_cart(Request $request, $id){

        $product_id = $id;

        $quantity = $request->quantity;

        $product = Product::find($id);

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
        $siteInfo = Siteinfo::first();

        return view('frontend.cart.ajax_popup_cart', compact('sub_total', 'total_item', 'contents', 'siteInfo'));

        // return response()->json([
        //     'sub_total' => $sub_total,
        //     'total_item' => $total_item,
        //     'contents' => $contents,
        // ]);

        

    }

    public function add_to_wishlist(Request $request, $id){

        $user_id = Session::get('user_id');
        $product_id = $id;

        $exist_data = Wishlist::where('user_id', $user_id)->where('product_id', $id)->first();

        if ($exist_data) {
            return response()->json([
                'exist' => 'Already added in wishlist',
            ]);
        }else{
            $data = new Wishlist();
            $data->user_id = $user_id;
            $data->product_id = $id;
            $data->save();

            $total_item = Wishlist::where('user_id', $user_id)->count();
            return response()->json([
                'total_item' => $total_item,
            ]);

        }


        

    }

    public function remove_from_cart($rowId){
        Cart::remove($rowId);


        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();

        return response()->json([
            'sub_total' => $sub_total,
            'total_item' => $total_item
        ]);


        // $contents = Cart::content();

        // return view('frontend.cart.cart_item', compact('contents', 'sub_total'));

    }

    public function increase_cart($rowId){


        $quantity = 1;
        if (!empty($rowId)) {

            $cart = Cart::get($rowId);
            Cart::update($rowId, $cart->qty + $quantity);


        }
        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();

        return response()->json([
            'cart' => $cart,
            'sub_total' => $sub_total,
            'total_item' => $total_item
        ]);


    }

    public function decrease_cart($rowId){


        $quantity = 1;
        if (!empty($rowId)) {

            $cart = Cart::get($rowId);
            Cart::update($rowId, $cart->qty - $quantity);


        }
        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();

        return response()->json([
            'cart' => $cart,
            'sub_total' => $sub_total,
            'total_item' => $total_item
        ]);


    }

    public function cart_page()
    {
        $contents = Cart::content();
        $cart_sub_total = Cart::subtotal();
        $sub_total = (float) str_replace(',', '', $cart_sub_total);
        $total_item = Cart::content()->count();
        $siteinfo = Siteinfo::first();
        $site_image = SiteImage::first();
        $latest_product = Product::orderBy('created_at', 'desc')->where('status', 1)->take(15)->get();
        return view('frontend.cart.cart_page', compact('contents', 'sub_total', 'total_item', 'siteinfo', 'latest_product', 'site_image'));
    }


    public function update_cart(Request $request){
        $rowid = $request->rowid;

        $quantity = $request->quantity;
        if (!empty($rowid)) {
            foreach ($quantity as $key => $value) {
                $cart = Cart::get($rowid[$key]);

                Cart::update($rowid[$key], $value);
            }

        }

        $contents = Cart::content();
        $sub_total = (float) str_replace(',', '', Cart::subtotal());

        return redirect()->back();
    } 


    public function cart_destroy()
    {

        Cart::destroy();

        return redirect()->back();
    }

    public function checkout()
    {
        $contents = Cart::content();
        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $total_item = Cart::content()->count();
        $payment_methods = PaymentMethod::where('status', 1)->get();
        $siteinfo  = Siteinfo::first();

        $discount = Session::get('discount');
        $coupon_percentage = Session::get('coupon_percentage');

        if($discount){
            $convert_total = ($sub_total + $siteinfo->tax) - $discount;
            $total = (float) str_replace(',', '', $convert_total);
        }else{
            $convert_total = $sub_total + $siteinfo->tax;
            $total = (float) str_replace(',', '', $convert_total);
        }

        $cities = City::where('status', 1)->get();
        $areas = Area::where('city_id', 1)->where('status', 1)->get();

        $site_image = SiteImage::first();

        if (count($contents) > 0 ) {
            return view('frontend.cart.checkout', compact('contents', 'sub_total', 'total_item', 'payment_methods', 'discount', 'coupon_percentage', 'total', 'siteinfo', 'cities', 'areas', 'site_image'));
        }else{
            return redirect()->back();
        }

    }

    public function place_order(Request $request)
    {
   
        $validatedData = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required',
                'area_id' => 'required',
                'transaction_id' => 'unique:orders',
                'payment_method' => 'required',
            ],
            [
                'fname.required' => 'First name is required',
                'lname.required' => 'Last name is required',
                'phone.required' => 'Phone number is required',
                'area_id.required' => ' Area is required',

            ]
        );

        $contents = Cart::content();
        if(count($contents) > 0){

            $payment_method = $request->payment_method;
            $transaction_id = $request->transaction_id;
            $isUrgent = $request->isUrgent;

            
            $area = Area::where('id', $request->area_id)->first();
            

            
            if($isUrgent == 'yes'){
                $isUrgent == 'yes';
                $urgent_charge = $area->urgent_charge;
            }else{
                $isUrgent == 'no';
                $urgent_charge = 0;
            }            
            
            
            $city = City::where('id', $area->city_id)->first();
            $user_id = Session::get('user_id');
            $coupone_code = Session::get('coupone_code');
            $discount = Session::get('discount');
            $coupon_percentage = Session::get('coupon_percentage');

            $invoice_id =  rand(10000,100000);
            $total_qty = Cart::count();
            $sub_total = Cart::subtotal();
            $total_cost = (float) str_replace(',', '', $sub_total);

            $user = User::where('phone', $request->phone)->first();
          
            if(!$user){
                $user = new User();
                $user->fname = $request->fname;
                $user->lname = $request->lname;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->postcode = $request->postcode ?? '';
                $user->city = $city->name;
                $user->area = $area->name;
                $user->password = Hash::make($request->password);
                $user->save();
                Session::put('user_id', $user->id);
            }else{
                User::where('phone', $request->phone)->update(
                    [
                        'address' => $request->address,
                        'city' => $city->name,
                        'area' => $area->name,
                        'postcode' => $request->postcode ?? '',
                    ]

                );
            }

            $order = new Order();
            $order->customer_id = $user->id ?? $user_id;
            $order->invoice_id = $invoice_id;
            $order->billing_address_id = 0;
            $order->shipping_address_id = 0;
            $order->total_qty = $total_qty;

            $order->discount = $discount ?? 0;
            $order->coupone_code = $coupone_code ?? '';

            if($area){
                $order->shipping_charge = $area->shipping_charge;

                if($discount){
                    $order->total_cost = ($total_cost - $discount) + $area->shipping_charge + $urgent_charge;
                }else{
                    $order->total_cost = $total_cost + $area->shipping_charge + $urgent_charge;
                }

            }

            $order->payment_method = $request->payment_method;
            $order->transaction_id = $request->transaction_id ?? '';
            $order->isUrgent = $isUrgent;
            $order->urgent_charge = $urgent_charge;
            $order->status = 0;
            $order->save();

            $order_id = $order->id;
            foreach ($contents as $content) {
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order_id;
                $orderDetails->product_id = $content->id;
                $orderDetails->product_price = $content->price;
                $orderDetails->qty_total_amount = $content->price * $content->qty;
                $orderDetails->color = $content->options->color;
                $orderDetails->unit = $content->options->unit;
                $orderDetails->size = $content->options->size;
                $orderDetails->qty = $content->qty;
                $orderDetails->save();  
            }


            Cart::destroy();

            Session::put('user_id', $user->id);


            Session::forget('coupone_code');
            Session::forget('discount');
            Session::forget('coupon_percentage');
            
            
            
   
            $siteinfo  = Siteinfo::first();
                    
            $ap_key='175460638611113220230110095725amCTgrLIUt'; 
            $sender_id='142';
            $mobile_no = $request->phone.','.$siteinfo->site_owner_number;
            $message = $request->fname.' '.$request->lname.' '.'is ordered'.' '.$total_qty.' '.' Items.'.' '.'Total Cost'.' '.$order->total_cost.' '.' Taka';
            $user_email='gravityeducation2019@gmail.com';

            
            
        	$url = 'https://24bulksms.com/24bulksms/api/api-sms-send';
        	$data = array('api_key' => $ap_key,
        	 'sender_id' => $sender_id,
        	 'message' => $message,
        	 'mobile_no' =>$mobile_no,
        	 'user_email'=> $user_email		
        	 );
        
        	// use key 'http' even if you send the request to https://...
        	 $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);     
            $output = curl_exec($curl);
            curl_close($curl);

      

            session()->flash('notif', "Your order submit successfully !!");
            
            Session::forget('user_id');
            
            
            return view('frontend.cart.thankyou');


        }else{
            return redirect('/');
        }




    }

    public function get_payment_method_data($id)
    {
        $data = PaymentMethod::where('id', $id)->first();
        return view('frontend.cart.get_payment_method_data',compact('data'));
    }

    public function submit_coupon(Request $request)
    {
        $sub_total = (float) str_replace(',', '', Cart::subtotal());
        $siteinfo = Siteinfo::first();
        $total = $sub_total + $siteinfo->shipping_charge + $siteinfo->tax;

        $coupon_code = $request->coupon_code;


        $coupon = Coupon::where('code', $coupon_code)->where('status', 1)->first();
        if($coupon){
            $discount = $total * $coupon->percentage / 100;

            Session::put('coupone_code', $coupon_code);
            Session::put('coupon_percentage', $coupon->percentage);
            Session::put('discount', $discount);

            return redirect()->back();

        }else{
            return redirect()->back();
        }

        


    }

    public function get_area(Request $request)
    {
        $areas = Area::where('city_id', $request->city_id)->get();
        return view('frontend.ajax.get_area',compact('areas'));
    }

    public function get_shipping_area(Request $request)
    {
        $areas = Area::where('city_id', $request->s_city_id)->get();
        return view('frontend.ajax.get_area',compact('areas'));
    }

    public function get_shipping_charge(Request $request)
    {
        $data = Area::where('id', $request->area_id)->first();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function get_urgent_charge(Request $request)
    {
        $data = Area::where('id', $request->area_id)->first();

        return response()->json([
            'data' => $data,
        ]);
    }



}
