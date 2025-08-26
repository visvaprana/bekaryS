<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Appointment;
use App\Models\Subscription;
use Validator;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($valid->fails()) {
            return response()->json(
                [
                'error' => $valid->errors(),
                'message' => 'Fill Up Your Form  !! ',
                'status' => 'Unprocessable Entity',
                ], 422 // success code
            );
        }

        $data = new ContactUs();
        $data->name=$request->name;
        $data->phone=$request->phone;
        $data->email=$request->email;
        $data->subject=$request->subject;
        $data->message=$request->message;
        $data->status="Pending";
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Your Message Successfully Submitted',
        ]);
    }

    public function appointment(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'date' => 'required',
            'time' => 'required',
            'problem_in_detail' => 'required',
        ]);

        if ($valid->fails()) {
            return response()->json(
                [
                'error' => $valid->errors(),
                'message' => 'Fill Up Your Form  !! ',
                'status' => 'Unprocessable Entity',
                ], 422 // success code
            );
        }

        $data = new Appointment();
        $data->name=$request->name;
        $data->phone=$request->phone;
        $data->email=$request->email;
        $data->subject=$request->subject;
        $data->date=$request->date;
        $data->time=$request->time;
        $data->problem_in_detail=$request->problem_in_detail;
        $data->status="Pending";
        $data->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Your Appointment Successfully Submitted',
        ]);
    }


    public function subscription(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);

        if ($valid->fails()) {
            return response()->json(
                [
                'error' => $valid->errors(),
                'message' => 'Fill Up Your Form  !! ',
                'status' => 'Unprocessable Entity',
                ], 422 // success code
            );
        }

        $data = new Subscription();
        $data->email=$request->email;
        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Subscription Successful',
        ]);
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
}
