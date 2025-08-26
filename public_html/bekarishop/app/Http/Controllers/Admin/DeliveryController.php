<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\DeliverymanToOrder;
use App\Models\Siteinfo;
use App\Models\SiteImage;
use App\Models\ShippingAddress;
use Str;

class DeliveryController extends Controller
{
    public function assign_delivery_man($id)
    {
        $order = Order::findorfail($id);
        $employees = Employee::all();

        $user = User::where('id', $order->customer_id)->first();

        $orderDetails = OrderDetail::where('order_id', $id)->get();


        $already_assign = DeliverymanToOrder::where('order_id', $id)->first();
        if($already_assign){
            $delivery_man = Employee::where('id', $already_assign->employee_id)->first();

            return view('admin.delivery.assign_delivery_man', compact('employees', 'order', 'user', 'orderDetails', 'already_assign', 'delivery_man'));
        }else{
            return view('admin.delivery.assign_delivery_man', compact('employees', 'order', 'user', 'orderDetails'));
        }

    }


    public function assign_delivery_man_store(Request $request){


        $already_assign = DeliverymanToOrder::where('order_id', $request->order_id)->first();

        if($already_assign){

            $data = DeliverymanToOrder::find($already_assign->id);
            $data->employee_id = $request->employee_id;
            $data->order_id = $request->order_id;
            $data->status = $request->status ?? 0;
            $data->save();


            Order::where('id', $request->order_id)->update([
                'status' => $request->status
            ]);

        }else{

            $data = new DeliverymanToOrder();
            $data->employee_id = $request->employee_id;
            $data->order_id = $request->order_id;
            $data->status = $request->status ?? 0;
            $data->save();

            Order::where('id', $request->order_id)->update([
                'status' => $request->status
            ]);
        }


        $notification=array(
            'message' => 'Delivery man assign successfully done !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function pos_invoice($id){

        $order = Order::findorfail($id);
        $orderDetails = OrderDetail::where('order_id', $id)->get();

        $user = User::where('id', $order->customer_id)->first();




        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();


        $toal_p_price = OrderDetail::where('order_id', $id)->sum('qty_total_amount');
        $shipping_address = ShippingAddress::where('order_id', $id)->first();
        $total_cost = ($order->shipping_charge + $toal_p_price + $site_info->tax) - $order->discount;


        return view('admin.delivery.pos_invoice', compact('order', 'user', 'orderDetails', 'site_info', 'site_image', 'toal_p_price', 'shipping_address', 'total_cost' ));
    }

































}
