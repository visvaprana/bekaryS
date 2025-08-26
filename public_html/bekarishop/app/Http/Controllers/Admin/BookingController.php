<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ContactUs;
use App\Models\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::get();
        return view('admin.booking.index', compact('bookings'));
    }
    
    public function contact_request()
    {
        $contacts = ContactUs::get();

        return view('admin.booking.contact_request', compact('contacts'));
    }
    
    public function edit_contact_request($id)
    {
        $data = ContactUs::findorfail($id);
        return view('admin.booking.edit_contact_request', compact('data'));

    }
    
    public function update_contact_request(Request $request, $id)
    {
        
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $address = $request->address;
        $message = $request->message;
        $type = $request->type;        
        $status = $request->status;        
        
        $data = ContactUs::findorfail($id);
        $data->name = $name;
        $data->email = $email;
        $data->phone = $phone;
        $data->subject = $subject;
        $data->address = $address;
        $data->message = $message;
        $data->type = $type;
        $data->status = $status;
        $data->save();
        
        
        $notification=array(
            'message' => 'Delete Successful !!',
            'alert-type' => 'danger'
        );
        return redirect()->back()->with($notification);

    }
    
    public function delete_contact_request($id)
    {
        $contact = ContactUs::findorfail($id);
        $contact->delete();
        
        
        $notification=array(
            'message' => 'Delete Successful !!',
            'alert-type' => 'danger'
        );
        return redirect()->back()->with($notification);

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
        $booking = Booking::findorfail($id);

        $user = User::where('id', $booking->user_id)->first();

        return view('admin.booking.edit', compact('booking', 'user'));
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
        $order = Booking::findorfail($id);
        $order->delete();

        $notification=array(
            'message' => 'Delete Successful !!',
            'alert-type' => 'danger'
        );
        return redirect()->back()->with($notification);
    }
}
