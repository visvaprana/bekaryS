<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use Str;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $posts = Post::where('status', 1)->get();
        return view('admin.post.index', compact('categories', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;

        $image = $request->file('image');
        if($image)
        {
            $image_name=str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'images/post_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(320, 250)->save();
            if($success)
            {
                $post->image = $image_url;
            }
        }
        $post->description = $request->description;
        $post->status = $request->status;
        $post->save();

        $category_id= $request->category_id;
        if ($category_id) {
            foreach ($category_id as $key => $value ){
                $post_category = new PostCategory();
                $post_category->post_id =$post->id;
                $post_category->category_id=$value;
                $post_category->save();
            }   
        }

        $notification=array(
            'message' => 'Post Saved Successfully !!',
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
        $data = Post::find($id);
        $categories = Category::where('status', 1)->get();
        $post_categories = PostCategory::where('post_id', $id)->get();
        return view('admin.post.edit', compact('categories', 'data', 'post_categories'));
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
        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->meta_keywords = $request->meta_keywords;

        $image = $request->file('image');
        if($image)
        {
            $image_name=str::random(5);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name. '.' .$ext;
            $upload_path = 'images/post_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(320, 250)->save();
            if($success)
            {
                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }

                $post->image = $image_url;
            }
        }
        $post->description = $request->description;
        $post->status = $request->status;
        $post->save();

        PostCategory::where('post_id', $id)->delete();
        $category_id= $request->category_id;
        if ($category_id) {
            foreach ($category_id as $key => $value ){
                $post_category = new PostCategory();
                $post_category->post_id =$post->id;
                $post_category->category_id=$value;
                $post_category->save();
            }   
        }

        $notification=array(
            'message' => 'Post Saved Successfully !!',
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
        $imagePath = Post::select('image')->where('id', $id)->first();

        $filePath = $imagePath->image;

        if (file_exists($filePath)) {
            unlink($filePath);
            Post::where('id', $id)->delete();
        }else{
            Post::where('id', $id)->delete();
        }
        
        $notification=array(
            'message' => 'Post Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }
}
