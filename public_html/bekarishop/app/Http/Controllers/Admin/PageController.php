<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Page_category;
use Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::get();
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Page_category::where('status', 1)->get();
        return view('admin.page.create', compact('categories'));
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
            'title' => 'required|unique:pages',
            'page_category_id' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        $category = new Page();
        $category->page_category_id = $request->page_category_id;
        $category->title = $request->title;
        $category->slug = str::slug($request->title);
        $category->content = $request->content;
        $category->status = $request->status;
        $category->save();
        $notification=array(
            'message' => 'Page Saved Successfully !!',
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
        $page = Page::findorfail($id);
        $categories = Page_category::where('status', 1)->get();
        return view('admin.page.edit', compact('page', 'categories'));
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
        $category = Page::findorfail($id);
        $category->page_category_id = $request->page_category_id;
        $category->title = $request->title;
        $category->slug = str::slug($request->title);
        $category->content = $request->content;
        $category->status = $request->status;
        $category->save();
        $notification=array(
            'message' => 'Page Updated Successfully !!',
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
        $page = Page::findorfail($id);

        
        
        $page->delete();
        $notification=array(
        'message' => 'Page Deleted Successfully !!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
}
