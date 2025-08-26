<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\SiteImage;
use App\Models\Siteinfo;

class ContactController extends Controller
{
    public function contact()
    {
        $siteInfo = Siteinfo::first();
        $site_image = SiteImage::first();
        return view('frontend.page.contact', compact('siteInfo', 'site_image'));
    }

    public function send_message(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $address = $request->address;
        $message = $request->message;
        $type = $request->type;

        $data = new ContactUs();
        $data->name = $name;
        $data->email = $email;
        $data->phone = $phone;
        $data->subject = $subject;
        $data->address = $address;
        $data->message = $message;
        $data->type = $type;
        $data->status = 'Pending';
        $data->save();

        session()->flash('notif', "Send Successful !! ");
        return redirect()->back();


    }
}
