<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Session;

class RatingController extends Controller
{
    public function submit_your_rate(Request $request)
    {

        $user_id = Session::get('user_id');

        if ($user_id) {
            $data = new Rating();
            $data->user_id = $user_id;
            $data->product_id = $request->product_id;
            $data->rate = $request->rate;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->website = $request->website;
            $data->comment = $request->comment;
            $data->save();

            session()->flash('submit_rating', "Successfully Submitted !!");
           
        }else{
            session()->flash('login', "Please login to your account !!");
        }
        return redirect()->back();

    }
}
