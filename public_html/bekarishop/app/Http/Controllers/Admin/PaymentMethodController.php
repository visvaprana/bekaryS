<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Str;
use Intervention\Image\Facades\Image;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment_method.index',compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);
        $data = new PaymentMethod();
        $data->title=$request->title;
        $data->slug=Str::slug($request->title);
        $data->account_no=$request->account_no;
        $data->account_holder=$request->account_holder;
        $data->account_type=$request->account_type;

        $image = $request->file('image');
        if($image)
        {
            $image_name= str::random(5);
            $image_full_name = $image_name;
            $upload_path = 'images/banner_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(60, 40)->save();
            if($success)
            {
                $data->image = $image_url;
            }
        }

        $data->status=$request->status;
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
        $data = PaymentMethod::where('id',$id)->first();
        return view('admin.payment_method.edit', compact('data'));
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
        $data = PaymentMethod::findorfail($id);
        $data->title=$request->title;
        $data->slug=Str::slug($request->title);
        $data->account_no=$request->account_no;
        $data->account_holder=$request->account_holder;
        $data->account_type=$request->account_type;

        $image = $request->file('image');
        if($image)
        {
            $image_name= str::random(5);
            $image_full_name = $image_name;
            $upload_path = 'images/banner_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(60, 40)->save();
            if($success)
            {

                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }

                $data->image = $image_url;
            }
        }

        $data->status=$request->status;
        $data->save();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagePath = PaymentMethod::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {
            unlink($filePath);
            PaymentMethod::where('id', $id)->delete();
        }else{
            PaymentMethod::where('id', $id)->delete();
        }
        
        $notification=array(
            'message' => 'PaymentMethod Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }
}
