<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'title' => 'required|unique:services',
            // 'start_price' => 'required',
            // 'short_description' => 'required',
            'image' => 'required',
            // 'icon' => 'required',
            // 'description' => 'required',
            // 'meta_title' => 'required',
            // 'meta_description' => 'required',
            // 'meta_keywords' => 'required',
            'status' => 'required',
        ]);
        $data = new Service();
        $data->title=$request->title;
        $data->slug=Str::slug($request->title);
        $data->start_price=$request->start_price;
        $data->short_description=$request->short_description;


        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/service_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(512, 400)->save();
            if($success)
            {
                $data->image = $image_url;
            }
        }



        $data->icon=$request->icon;
        $data->description=$request->description;
        $data->meta_title=$request->meta_title;
        $data->meta_description=$request->meta_description;
        $data->meta_keywords=$request->meta_keywords;
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
        $data = Service::where('id',$id)->first();
        return view('admin.service.edit',compact('data'));
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
        $data = Service::find($id);
        $data->title=$request->title;
        $data->slug=Str::slug($request->title);
        $data->start_price=$request->start_price;
        $data->short_description=$request->short_description;

        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/service_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(512, 400)->save();
            if($success)
            {
                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }
                $data->image = $image_url;
            }
        }

        $data->icon=$request->icon;
        $data->description=$request->description;
        $data->meta_title=$request->meta_title;
        $data->meta_description=$request->meta_description;
        $data->meta_keywords=$request->meta_keywords;
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
        $imagePath = Service::select('image')->where('id', $id)->first();
        $filePath = $imagePath->image;
        if (file_exists($filePath)) {
            unlink($filePath);
            Service::where('id', $id)->delete();
        }else{
            Service::where('id', $id)->delete();
        }
        $notification=array(
            'message' => 'Service Deleted Successfully !!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
