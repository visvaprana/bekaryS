<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resturant;
use App\Models\Item;
use App\Models\ItemPackage;
use Str;
use Intervention\Image\Facades\Image;

class ItemPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resturants = Resturant::where('status', 1)->get();
        $items = Item::where('status', 1)->get();
        $item_packages = ItemPackage::where('status', 1)->get();
        return view('admin.item_package.index',compact('items', 'resturants', 'item_packages'));
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
            'resturant_id' => 'required',
            'item_id' => 'required',
            'name' => 'required | unique:item_packages',
            'price' => 'required',
        ]);

        $data = new ItemPackage();
        $data->resturant_id=$request->resturant_id;
        $data->item_id=$request->item_id;
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
        $data->price=$request->price;


        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/item_package_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(200, 200)->save();
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

        $data = ItemPackage::findorfail($id);
        $resturants = Resturant::where('status', 1)->get();
        $items = Item::where('resturant_id', $data->resturant_id)->where('status', 1)->get();

        return view('admin.item_package.edit', compact( 'resturants', 'data', 'items'));
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
        $data = ItemPackage::find($id);
        $data->resturant_id=$request->resturant_id;
        $data->item_id=$request->item_id;
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
        $data->price=$request->price;


        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/item_package_image/';
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
        $imagePath = ItemPackage::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {
            unlink($filePath);
            ItemPackage::where('id', $id)->delete();
        }else{
            ItemPackage::where('id', $id)->delete();
        }
        
        $notification=array(
            'message' => 'ItemPackage Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }

    public function get_item(Request $request){
        $items = Item::where('resturant_id', $request->resturant_id)->get();
        return view('admin.item_package.get_item',compact('items'));
    }

}
