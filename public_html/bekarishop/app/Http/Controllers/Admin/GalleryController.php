<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Str;
use Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.gallery.index',compact('galleries'));
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
        $validatedData = $request->validate([
            'image' => 'required',
        ]);

        $data = new Gallery();
        $data->title=$request->title;
        $image = $request->file('image');
        if($image)
        {
            $image_name= str::random(5);
            $original_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$original_extension;
            $upload_path = 'images/gallery_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(290, 290)->save();
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
        $data = Gallery::where('id',$id)->first();
        return view('admin.gallery.edit',compact('data'));
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
        $data = Gallery::find($id);
        $data->title=$request->title;
        $image = $request->file('image');
        if($image)
        {
            $image_name= str::random(5);
            $original_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$original_extension;
            $upload_path = 'images/gallery_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(290, 290)->save();
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
        $imagePath = Gallery::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {
            unlink($filePath);
            Gallery::where('id', $id)->delete();
        }else{
            Gallery::where('id', $id)->delete();
        }
        
        $notification=array(
            'message' => 'Gallery Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }
}
