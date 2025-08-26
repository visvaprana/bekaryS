<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
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
            'name' => 'required',
            'slug' => 'unique:categories',
        ]);
        $data = new Category();
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
        $data->parent_id=$request->parent_id ?? 0;
        $data->description=$request->description;
        $data->status=$request->status;

        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;

        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $original_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$original_extension;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success)
            {
                $data->image = $image_url;
            }
        }

        $meta_image = $request->file('meta_image');
        if($meta_image)
        {
            $image_name= $meta_image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $meta_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(800, 400)->save();
            if($success)
            {
                $data->meta_image = $image_url;
            }
        }


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
        $categories = Category::all();
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data', 'categories'));
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
        $data = Category::find($id);
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
        $data->parent_id=$request->parent_id ?? '0';
        $data->description=$request->description;
        $data->status=$request->status;

        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;


        $image = $request->file('image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $original_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$original_extension;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success)
            {
                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }

                $data->image = $image_url;
            }
        }

        $meta_image = $request->file('meta_image');
        if($meta_image)
        {
            $image_name= $meta_image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $meta_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(800, 400)->save();
            if($success)
            {
                $old_meta_image = $request->old_meta_image;
                if (file_exists($old_meta_image)) {
                    unlink($request->old_meta_image);
                }
                
                $data->meta_image = $image_url;
            }
        }

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
        $imagePath = Category::select('image')->where('id', $id)->first();
        $metaImagePath = Category::select('meta_image')->where('id', $id)->first();

        $filePath = $imagePath->image;
        $metaFilePath = $metaImagePath->meta_image;

        if (file_exists($filePath) || file_exists($metaFilePath)) {
            unlink($filePath);
            unlink($metaFilePath);
            Category::where('id', $id)->delete();
        }else{
            Category::where('id', $id)->delete();
        }

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }
}
