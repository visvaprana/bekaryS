<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Area;
use App\Models\Resturant;
use Str;
use Intervention\Image\Facades\Image;

class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where('status', 1)->get();
        $cities = City::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();

        $resturants = Resturant::get();

        return view('admin.resturant.index', compact('cities', 'countries', 'areas', 'resturants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::where('status', 1)->get();
        $cities = City::where('status', 1)->get();
        $countries = Country::where('status', 1)->get();
        
        return view('admin.resturant.create', compact('cities', 'countries', 'areas'));
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
            'name' => 'required|unique:resturants',
            'country_id' => 'required',
            'city_id' => 'required',
            'area_id' => 'required',
            'address' => 'required',
            'opening_time' => 'required',
            'delivery_hours' => 'required',
            'open_closed' => 'required',
            'status' => 'required',
        ]);

        $data = new Resturant();
        $data->country_id = $request->country_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->discount = $request->discount;
        $data->address = $request->address;
        $data->opening_time = $request->opening_time;
        $data->delivery_hours = $request->delivery_hours;
        $data->open_closed = $request->open_closed;
        $data->status = $request->status;


        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;

        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/resturant_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(200, 200)->save();
            if($success)
            {
                $data->image = $image_url;
            }
        }


        $cover_image = $request->file('cover_image');
        if($cover_image)
        {
            $image_name= $cover_image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/resturant_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $cover_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1600, 400)->save();
            if($success)
            {
                $data->cover_image = $image_url;
            }
        }


        $data->save();

        $notification=array(
            'message' => 'Resturant Saved Successfully !!',
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
        $data = Resturant::find($id);

        $countries = Country::where('status', 1)->get();
        $cities = City::where('country_id', $data->country_id)->where('status', 1)->get();
        $areas = Area::where('city_id', $data->city_id)->where('status', 1)->get();
        
        return view('admin.resturant.edit', compact('cities', 'countries', 'areas', 'data'));
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
        $data = Resturant::find($id);
        $data->country_id = $request->country_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->discount = $request->discount;
        $data->address = $request->address;
        $data->opening_time = $request->opening_time;
        $data->delivery_hours = $request->delivery_hours;
        $data->open_closed = $request->open_closed;
        $data->status = $request->status;


        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;

        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/resturant_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(200, 200)->save();
            if($success)
            {
                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }
                $data->image = $image_url;
            }
        }


        $cover_image = $request->file('cover_image');
        if($cover_image)
        {
            $image_name= $cover_image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/resturant_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $cover_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1600, 400)->save();
            if($success)
            {
                $old_cover_image = $request->old_cover_image;
                if (file_exists($old_cover_image)) {
                    unlink($request->old_cover_image);
                }
                $data->cover_image = $image_url;
            }
        }


        $data->save();

        $notification=array(
            'message' => 'Resturant Updated Successfully !!',
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
        $imagePath = Resturant::select('image')->where('id', $id)->first();
        $coverImagePath = Resturant::select('cover_image')->where('id', $id)->first();

        $filePath = $imagePath->image;
        $coverFilePath = $coverImagePath->cover_image;

        if (file_exists($filePath) || file_exists($coverFilePath) ) {
            unlink($filePath);
            unlink($coverFilePath);
            Resturant::where('id', $id)->delete();
        }else{
            Resturant::where('id', $id)->delete();
        }
        
        $notification=array(
            'message' => 'Resturant Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }
}
