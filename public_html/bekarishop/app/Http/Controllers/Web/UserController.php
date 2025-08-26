<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wishlist;
use App\Models\Subscription;
use App\Models\BillingAddress;
use App\Models\ShippingAddress;
use App\Models\Siteinfo;
use App\Models\SiteImage;
use App\Models\Area;
use App\Models\City;
use Hash;
use Auth;
use Session;



class UserController extends Controller
{
    public function register()
    {
        $site_image = SiteImage::first();
        return view('frontend.user.register', compact('site_image'));
    }
    public function login_page()
    {
        $site_image = SiteImage::first();
        return view('frontend.user.login', compact('site_image'));
    }
    public function registration(Request $request)
    {

        $validatedData = $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',

                'phone' => 'required|unique:users',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            ],
            [
                'fname.required' => 'Last name is required',
                'lname.required' => 'First name is required',

                'phone.required' => 'Phone Number is required',
            ]
        );

        $data = new User();
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->password = Hash::make($request->password);
        $data->password_str = $request->password;
        $data->save();

        Session::put('user_id', $data->id);
        Session::put('phone', $data->phone);

        session()->flash('notif', "Registration Successful !! ");
        // return redirect()->back();
        return redirect('/');

    }

    public function login(Request $request)
    {

        $validatedData = $request->validate(
            [
                'phone' => 'required',
            ],
            [
                'phone.required' => 'Phone Number is required',
            ]
        );

        $phone = $request->phone;
        $password = bcrypt($request->password);

        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('phone', $phone)->first();

            Session::put('user_id', $user->id);
            Session::put('phone', $user->phone);
            return redirect('/');

        }elseif($phone && !$password){
            $user = User::where('phone', $phone)->first();

            Session::put('user_id', $user->id);
            Session::put('phone', $user->phone);
            return redirect('/');
        }else{

            session()->flash('wrong_notif', "Email Or Password Wrong ");
            return redirect()->back();
        }

    }

    public function checkout_login(Request $request)
    {

        $validatedData = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email is required',
                'password.required' => 'Password is required',
            ]
        );

        $email = $request->email;
        $password = bcrypt($request->password);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $email)->first();

            Session::put('user_id', $user->id);
            Session::put('email', $user->email);
            return redirect('checkout');

        }else{

            session()->flash('wrong_notif', "Email Or Password Wrong ");
            return redirect()->back();
        }

    }

    public function account()
    {
        $user_id = Session::get('user_id');
        $user = User::where('id', $user_id)->first();
        $areas = Area::where('status', 1)->get();
        $site_image = SiteImage::first();
        return view('frontend.user.account', compact('user', 'areas', 'site_image'));
    }

    public function track_order(Request $request)
    {
        $user_id = Session::get('user_id');
        $user = User::where('id', $user_id)->first();

        $invoice_id = $request->invoice_id;
        $order = Order::where('invoice_id', $invoice_id)->where('customer_id', $user_id)->first();
        $site_image = SiteImage::first();

        return view('frontend.user.info.track_order', compact('user', 'order', 'site_image'));
    }

    public function update_profile(Request $request)
    {
        // $this->validate($request, [
        //     'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        // ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        $area = Area::where('id', $request->area_id)->first();
        $city = City::where('id', $area->city_id)->first();

        User::where('email', $email)
            ->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $city->name,
                'area' => $area->name,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'password_str' => $request->password_str

            ]);

        session()->flash('notif', "Information Update Successfull");
        return redirect()->back();


    }

    public function wishlist()
    {
        $user_id = Session::get('user_id');
        $total_wishlist_item = Wishlist::where('user_id', $user_id)->count();
        $lists = Wishlist::where('user_id', $user_id)->get();
        return view('frontend.user.wishlist', compact('total_wishlist_item', 'lists'));
    }

    public function remove_from_wishlist($id)
    {

        $user_id = Session::get('user_id');
        Wishlist::where('product_id', $id)->where('user_id', $user_id)->delete();

        $total_wishlist_item = Wishlist::where('user_id', $user_id)->count();
        $lists = Wishlist::where('user_id', $user_id)->get();

        return response()->json([
            'total_wishlist_item' => $total_wishlist_item,
        ]);
        
    }

    public function subscription(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:subscriptions',
        ]);

        $subscription = new Subscription();
        $subscription->email = $request->email;
        $subscription->save();
        $notification=array(
            'message' => 'Subscription Successfully Done!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
      

    }

    public function order_details($id)
    {
        $user_id = Session::get('user_id');
        $order = Order::find($id);


        if ($order && $order->customer_id == $user_id) {
            $orderDetails = OrderDetail::where('order_id', $id)->get();
            $billing = BillingAddress::where('customer_id', $order->customer_id)->first();
            $user = User::where('id', $order->customer_id)->first();
            $shipping = ShippingAddress::where('order_id', $id)->first();
            $toal_p_price = OrderDetail::where('order_id', $id)->sum('qty_total_amount');
            $site_info = Siteinfo::first();
            $site_image = SiteImage::first();
            

            $shipping_address = ShippingAddress::where('order_id', $id)->first();
            $total_cost = ($order->shipping_charge + $toal_p_price + $site_info->tax) - $order->discount;
                
            
            return view('frontend.user.info.order_details', compact('order', 'billing', 'shipping', 'orderDetails', 'toal_p_price', 'site_image', 'site_info', 'user', 'shipping_address', 'total_cost'));
        }else{
            return redirect()->back();
        }

    }

    public function logout(){
        Session::flush();
        return Redirect('/');
    }

    public function forgot_password()
    {
        return view('frontend.user.forgot_password');
    }

    public function verify(Request $request)
    {
        
        $this->validate($request, [
            'phone' => 'required',
        ]);  
        
        $user = User::where('phone', $request->phone)->first();
        if($user){
            
            $otp = rand(1111, 9999).''.$user->id;
            
            User::where('phone', $request->phone)->update([
                'reset_otp' => $otp
            ]);
            
                    
            $ap_key='175460638611113220230110095725amCTgrLIUt'; 
            $sender_id='142';
            $mobile_no = $user->phone;
            $message = $otp.' '.' - হল উপনার যাচাইকরণ কোড';
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
            
            
            
            return redirect()->route('verify-otp');
        }else{
            session()->flash('error', "Phone Number doesn't match !! ");
            return redirect()->back();
        }
        

    }

    public function verify_otp()
    {
        
        return view('frontend.user.verify_otp');
        

    }

    public function reset_password(Request $request)
    {
        
        $user = User::where('reset_otp', $request->reset_otp)->first();
        
        if($user){
           
            return redirect()->route('new-password', ['user_id' => encrypt($user->id)]);
        }else{
            session()->flash('error', "OTP doesn't match !! ");
            return redirect()->back();
        }        
        
        
        return view('frontend.user.verify_otp');
        

    }
    

    public function new_password($user_id)
    {
   
        
        return view('frontend.user.new_password', compact('user_id'));
        

    }    
    

    public function verify_account(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $email = $request->email;
        $exist_user = User::where('email', $email)->first();
        if ($exist_user) {
            return view('frontend.user.new_password', compact('email'));
        }else{
            session()->flash('error', "Information doesn't match !! ");
            return redirect()->back();
        }
    }

    public function update_password(Request $request)
    {
        
        $validatedData = $request->validate(
            [
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            ]
        );

        $user_id = $request->user_id;
        $user = User::where('id', decrypt($user_id))->first();

        User::where('id', decrypt($user_id))
            ->update([
                'password' => Hash::make($request->password)
            ]);

        // session()->flash('success', "Password update Successful !! ");
        // return redirect()->back();

        return redirect()->route( 'login' );





    }



}
