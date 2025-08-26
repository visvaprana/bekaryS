<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\Admin;
use App\Models\Color;
use App\Models\Size;
use App\Models\Unit;
use App\Models\Product;

use App\Models\ProductCategory;
use App\Models\ProductBrand;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductUnit;
use App\Models\ProductHighLight;
use App\Models\ProductSpecification;
use App\Models\ProductTerm;
use App\Models\ProductStockStatus;
use App\Models\ProductImage;

use Str;
use Image;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::orderBy('serial', 'asc')->paginate(50);
        return view('admin.product.index', compact('products'));
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Session::get('adminId');
        $user_by_id = Admin::where('id',$id)->first();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();        
        $attributes = Attribute::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        return view('admin.product.create', compact('categories', 'brands', 'attributes', 'colors', 'sizes', 'units'));
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
            'name' => 'required|unique:products',
            'category_id.*' => 'required',
            'image' => 'required',
            'serial' => 'required',
            'status' => 'required',
        ]);

        $id = Session::get('adminId');
        $user_by_id = Admin::where('id',$id)->first();

        $data = new Product();
        // compatitable product add
        $data->admin_id = $id;
        $data->serial = $request->serial;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->code = $request->code ?? '';
        $data->sku = $request->sku ?? '';

        $data->buying_price = $request->buying_price ?? '0.00';
        $data->sell_price = $request->sell_price;
        $data->discount = $request->discount;
        
        if($request->discount && $request->discount > 0){
            $data->discount_price = $request->discount_price;
        }else{
            $data->discount_price = 0;
        }


        $data->qty = $request->qty;
        $data->total_sell = $request->total_sell ?? '0';
        $data->total_product = $request->total_product ?? '0';

        $data->min_order_qty = $request->min_order_qty ?? '0';
        $data->max_order_qty = $request->max_order_qty ?? '0';
        $data->warranty = $request->warranty;

        $data->description = $request->description;
        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;

        $data->note = $request->note ?? '';


        $data->image_alt = $request->image_alt;
        $data->image_des = $request->image_des;


        $image = $request->file('image');

        $upload_path     = null;
        if($image) {

            $image_name= str::random(5);
            $original_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$original_extension;
            $upload_path = 'images/product_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(288,187)->save();
            if($success) {
                $data->image = $image_url;
            }

            // making 4 diffrent sizes of the featured image
            $product_image_path = base_path() . '/images/product_image/';
            $names = ['thumb', 'small', 'medium', 'large'];
            $sizes = [160, 480, 800, 1600];
            $table_fields = ['product_image_thumb', 'product_image_small', 'product_image_medium', 'product_image_large'];
            for($i = 0; $i < 4; $i++) {
                $image = Image::make($product_image_path . $image_full_name);
                $image->widen($sizes[$i]);
                $image->save($product_image_path . $names[$i] . $image_full_name);
                $field_name = $table_fields[$i];
                $data->$field_name = 'images/product_image/' . $names[$i].$image_full_name;
            }
        }

        $data->status = $request->status;
        $data->save();



        $category_id= $request->category_id;
        if ($category_id) {
            foreach ($category_id as $key => $value ){
                if(!empty($value)){
                    $product_category= new ProductCategory();
                    $product_category->product_id =$data->id;
                    $product_category->category_id=$value;
                    $product_category->save(); 
                }
            }   
        }


        // $brand_id= $request->brand_id;
        // if ($brand_id) {
        //     foreach ($brand_id as $key => $value ){
        //         if(!empty($value)){
        //             $product_brand= new ProductBrand();
        //             $product_brand->product_id =$data->id;
        //             $product_brand->brand_id=$value;
        //             $product_brand->save(); 
        //         }
        //     }   
        // }


        // $color_id= $request->color_id;
        // if ($color_id) {
        //     foreach ($color_id as $key => $value ){
        //         if(!empty($value)){
        //             $product_color= new ProductColor();
        //             $product_color->product_id =$data->id;
        //             $product_color->color_id=$value;
        //             $product_color->save(); 
        //         }
        //     }   
        // }


        $size_id= $request->size_id;
        if ($size_id) {
            foreach ($size_id as $key => $value ){
                if(!empty($value)){
                    $product_size= new ProductSize();
                    $product_size->product_id =$data->id;
                    $product_size->size_id=$value;
                    $product_size->save(); 
                }
            }   
        }


        $unit_id= $request->unit_id;
        if ($unit_id) {
            foreach ($unit_id as $key => $value ){
                if(!empty($value)){
                    $product_unit= new ProductUnit();
                    $product_unit->product_id =$data->id;
                    $product_unit->unit_id=$value;
                    $product_unit->save(); 
                }
            }   
        }

        // $highlights= $request->highlights;
        // if ($highlights) {
        //     foreach ($highlights as $key => $value ){
        //         if(!empty($value)){
        //             $highlight= new ProductHighLight();
        //             $highlight->product_id =$data->id;
        //             $highlight->highlights=$value;
        //             $highlight->save();
        //         }
        //     }   
        // }

        $specification= $request->specification;
        if ($specification) {
            foreach ($specification as $key => $value ){
                if(!empty($value)){
                    $spec= new ProductSpecification();
                    $spec->product_id =$data->id;
                    $spec->specification=$value;
                    $spec->save();
                }
            }   
        }

        // $terms= $request->terms;
        // if ($terms) {
        //     foreach ($terms as $key => $value ){
        //         if(!empty($value)){
        //             $product_terms= new ProductTerm();
        //             $product_terms->product_id =$data->id;
        //             $product_terms->terms=$value;
        //             $product_terms->save();
        //         }
        //     }   
        // }


        $stock_status= $request->stock_status;
        if ($stock_status) {
            foreach ($stock_status as $key => $value ){
                if(!empty($value)){
                    $product_stock_status= new ProductStockStatus();
                    $product_stock_status->product_id =$data->id;
                    $product_stock_status->stock_status=$value;
                    $product_stock_status->save();
                }
            }   
        }

        $images = $request->file('product_image');
        $product_image_alt= $request->product_image_alt;
        $product_image_des= $request->product_image_des;

        if ($images) {
            foreach ($images as $key => $value ){
                $product_image = new ProductImage();
                $image_name=str::random(5);
                $original_extension = $value->getClientOriginalExtension();
                $image_full_name = $image_name.'.'.$original_extension;
                $upload_path = 'images/product_more_image/';
                $image_url = $upload_path.$image_full_name;
                $success = $value->move($upload_path, $image_full_name);
                // $img = Image::make($image_url)->resize(288,259)->save();
                $product_image->product_id = $data->id;
                $product_image->product_image = $image_url;

                $product_image->product_image_alt=$product_image_alt[$key];
                $product_image->product_image_des=$product_image_des[$key];

                // create thumbnail of productimages
                $product_image_path = base_path() . '/images/product_more_image/';
                $image = Image::make($product_image_path . $image_full_name);
                $image->widen(160);
                $image_name = 'thumb_' . $image_full_name;
                $image->save($product_image_path . $image_name);
                $product_image->product_image_thumb = $upload_path . $image_name;
                // end create thumbnail

                $product_image->save();
            }
        }


        $notification=array(
            'message' => 'Product Saved Successfully !!',
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
        $data = Product::find($id);

        $adminId = Session::get('adminId');
        $user_by_id = Admin::where('id',$adminId)->first();
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();        
        $attributes = Attribute::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        $ProductCategories = ProductCategory::where('product_id', $id)->get();
        $productBrands = ProductBrand::where('product_id', $id)->get();
        $ProductColors = ProductColor::where('product_id', $id)->get();
        $ProductSizes = ProductSize::where('product_id', $id)->get();
        $ProductUnits = ProductUnit::where('product_id', $id)->get();
        $ProductHighLights = ProductHighLight::where('product_id', $id)->get();
        $ProductSpecifications = ProductSpecification::where('product_id', $id)->get();
        $ProductTerms = ProductTerm::where('product_id', $id)->get();
        $ProductStockStatus = ProductStockStatus::where('product_id', $id)->get();
        $productImages = ProductImage::where('product_id', $id)->get();


        return view('admin.product.edit', compact('categories', 'brands', 'attributes', 'colors', 'sizes', 'units', 'data', 'ProductCategories', 'productBrands', 'ProductColors', 'ProductSizes', 'ProductUnits', 'ProductHighLights', 'ProductSpecifications', 'ProductSpecifications', 'ProductTerms', 'ProductStockStatus', 'productImages'));
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


        $adminId = Session::get('adminId');
        $user_by_id = Admin::where('id',$adminId)->first();

        $data = Product::find($id);
        // compatitable product add
        $data->admin_id = $user_by_id->id;
        $data->serial = $request->serial;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->code = $request->code;
        $data->sku = $request->sku;

        $data->buying_price = $request->buying_price;
        $data->sell_price = $request->sell_price;
        $data->discount = $request->discount;
        
        if($request->discount && $request->discount > 0){
            $data->discount_price = $request->discount_price;
        }else{
            $data->discount_price = 0;
        }


        $data->qty = $request->qty;
        $data->total_sell = $request->total_sell ?? '0';
        $data->total_product = $request->total_product ?? '0';

        $data->min_order_qty = $request->min_order_qty;
        $data->max_order_qty = $request->max_order_qty;
        $data->warranty = $request->warranty;

        $data->description = $request->description;
        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;

        $data->note = $request->note ?? '';


        $data->image_alt = $request->image_alt;
        $data->image_des = $request->image_des;


        $image = $request->file('image');

        $upload_path     = null;
        if($image) {

            $image_name= str::random(5);
            $original_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name.'.'.$original_extension;
            $upload_path = 'images/product_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(288,187)->save();
            if($success) {

                $old_image = $request->old_image;
                if (file_exists($old_image)) {
                    unlink($request->old_image);
                }

                $data->image = $image_url;
            }

            // making 4 diffrent sizes of the featured image
            $product_image_path = base_path() . '/images/product_image/';
            $names = ['thumb', 'small', 'medium', 'large'];
            $sizes = [160, 480, 800, 1600];
            $table_fields = ['product_image_thumb', 'product_image_small', 'product_image_medium', 'product_image_large'];
            for($i = 0; $i < 4; $i++) {
                $image = Image::make($product_image_path . $image_full_name);
                $image->widen($sizes[$i]);
                $image->save($product_image_path . $names[$i] . $image_full_name);
                $field_name = $table_fields[$i];
                $data->$field_name = 'images/product_image/' . $names[$i].$image_full_name;
            }
        }

        $data->status = $request->status;
        $data->save();


        ProductCategory::where('product_id', $id)->delete();
        $category_id= $request->category_id;
        if ($category_id) {
            foreach ($category_id as $key => $value ){
                if(!empty($value)){
                    $product_category= new ProductCategory();
                    $product_category->product_id =$data->id;
                    $product_category->category_id=$value;
                    $product_category->save(); 
                }
            }   
        }

        ProductBrand::where('product_id', $id)->delete();
        $brand_id= $request->brand_id;
        if ($brand_id) {
            foreach ($brand_id as $key => $value ){
                if(!empty($value)){
                    $product_brand= new ProductBrand();
                    $product_brand->product_id =$data->id;
                    $product_brand->brand_id=$value;
                    $product_brand->save(); 
                }
            }   
        }

        ProductColor::where('product_id', $id)->delete();
        $color_id= $request->color_id;
        if ($color_id) {
            foreach ($color_id as $key => $value ){
                if(!empty($value)){
                    $product_color= new ProductColor();
                    $product_color->product_id =$data->id;
                    $product_color->color_id=$value;
                    $product_color->save(); 
                }
            }   
        }

        ProductSize::where('product_id', $id)->delete();
        $size_id= $request->size_id;
        if ($size_id) {
            foreach ($size_id as $key => $value ){
                if(!empty($value)){
                    $product_size= new ProductSize();
                    $product_size->product_id =$data->id;
                    $product_size->size_id=$value;
                    $product_size->save(); 
                }
            }   
        }

        ProductUnit::where('product_id', $id)->delete();
        $unit_id= $request->unit_id;
        if ($unit_id) {
            foreach ($unit_id as $key => $value ){
                if(!empty($value)){
                    $product_unit= new ProductUnit();
                    $product_unit->product_id =$data->id;
                    $product_unit->unit_id=$value;
                    $product_unit->save(); 
                }
            }   
        }

        ProductHighLight::where('product_id', $id)->delete();
        $highlights= $request->highlights;
        if ($highlights) {
            foreach ($highlights as $key => $value ){
                if(!empty($value)){
                    $highlight= new ProductHighLight();
                    $highlight->product_id =$data->id;
                    $highlight->highlights=$value;
                    $highlight->save();
                }
            }   
        }

        ProductSpecification::where('product_id', $id)->delete();
        $specification= $request->specification;
        if ($specification) {
            foreach ($specification as $key => $value ){
                if(!empty($value)){
                    $spec= new ProductSpecification();
                    $spec->product_id =$data->id;
                    $spec->specification=$value;
                    $spec->save();
                }
            }   
        }

        ProductTerm::where('product_id', $id)->delete();
        $terms= $request->terms;
        if ($terms) {
            foreach ($terms as $key => $value ){
                if(!empty($value)){
                    $product_terms= new ProductTerm();
                    $product_terms->product_id =$data->id;
                    $product_terms->terms=$value;
                    $product_terms->save();
                }
            }   
        }

        ProductStockStatus::where('product_id', $id)->delete();
        $stock_status= $request->stock_status;
        if ($stock_status) {
            foreach ($stock_status as $key => $value ){
                if(!empty($value)){
                    $product_stock_status= new ProductStockStatus();
                    $product_stock_status->product_id =$data->id;
                    $product_stock_status->stock_status=$value;
                    $product_stock_status->save();
                }
            }   
        }

        $images = $request->file('product_image');
        $product_image_alt= $request->product_image_alt;
        $product_image_des= $request->product_image_des;

        if ($images) {
            foreach ($images as $key => $value ){
                $product_image = new ProductImage();
                $image_name=str::random(5);
                $original_extension = $value->getClientOriginalExtension();
                $image_full_name = $image_name.'.'.$original_extension;
                $upload_path = 'images/product_more_image/';
                $image_url = $upload_path.$image_full_name;
                $success = $value->move($upload_path, $image_full_name);
                // $img = Image::make($image_url)->resize(255, 300)->save();
                $product_image->product_id = $data->id;
                $product_image->product_image = $image_url;

                $product_image->product_image_alt=$product_image_alt[$key];
                $product_image->product_image_des=$product_image_des[$key];

                // create thumbnail of productimages
                $product_image_path = base_path() . '/images/product_more_image/';
                $image = Image::make($product_image_path . $image_full_name);
                $image->widen(160);
                $image_name = 'thumb_' . $image_full_name;
                $image->save($product_image_path . $image_name);
                $product_image->product_image_thumb = $upload_path . $image_name;
                // end create thumbnail

                $product_image->save();
            }
        }

        $notification=array(
            'message' => 'Product Saved Successfully !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);



    }


    public function update_multi_image(Request $request)
    {
        $images = $request->product_image;

        // $images = $request->file('product_image');
        $product_image_alt= $request->product_image_alt;
        $product_image_des= $request->product_image_des;

        if ($images) {
            foreach ($images as $key => $value ){
                
                $p_image = ProductImage::where('id', $key)->first();

                if($p_image){
                    if (file_exists($p_image->product_image)) {
                        unlink($p_image->product_image);
                    }
                    if (file_exists($p_image->product_image_thumb)) {
                        unlink($p_image->product_image_thumb);
                    }
                    // ProductImage::where('id', $key)->delete();
                }   

                //Update Images
                $image_name=str::random(5);
                $original_extension = $value->getClientOriginalExtension();
                $image_full_name = $image_name.'.'.$original_extension;
                $upload_path = 'images/product_more_image/';
                $image_url = $upload_path.$image_full_name;
                $success = $value->move($upload_path, $image_full_name);

                // $img = Image::make($image_url)->resize(255, 300)->save(); //no need this line
                // $product_image->product_id = $data->id;
                // $product_image->product_image = $image_url;

                // $product_image->product_image_alt=$product_image_alt[$key];
                // $product_image->product_image_des=$product_image_des[$key];

                // create thumbnail of productimages
                $product_image_path = base_path() . '/images/product_more_image/';
                $image = Image::make($product_image_path . $image_full_name);
                $image->widen(160);
                $image_name = 'thumb_' . $image_full_name;
                $image->save($product_image_path . $image_name);
                // $product_image->product_image_thumb = $upload_path . $image_name;
                // end create thumbnail

                ProductImage::where('id', $key)->update([
                    'product_image' => $image_url,
                    'product_image_thumb' => $upload_path . $image_name,
                    'product_image_alt' => '',
                    'product_image_des' => '',
                    'product_id' => $request->product_id,

                ]);

            }
        }


        $notification=array(
            'message' => 'Product Saved Successfully !!',
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
        $imagePath = Product::select('image')->where('id', $id)->first();
        $filePath = $imagePath->image;
        if (file_exists($filePath)) {
            try {
                unlink($filePath);
            } catch (\Throwable $th) {
            
            }
            Product::where('id', $id)->delete();
        }else{
            Product::where('id', $id)->delete();
        }

        $ProductImages = ProductImage::select('product_image')->where('product_id', $id)->get();
        foreach ($ProductImages as $key => $value) {
            try {
                unlink($value->product_image);
            } catch (\Throwable $th) {
            
            }
        }

        // remove old thumbnail
        foreach ($ProductImages as $key => $value) {
            $image_absolute_path = base_path() . '/' . $value->product_image_thumb;
            if (file_exists($image_absolute_path)) {
                try {
                    unlink($image_absolute_path);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                
            }
        } 

        $ProductCategory = ProductCategory::where('product_id', $id)->delete();
        $ProductBrand = ProductBrand::where('product_id', $id)->delete();
        $ProductColor = ProductColor::where('product_id', $id)->delete(); 
        $ProductSize = ProductSize::where('product_id', $id)->delete(); 
        $ProductUnit = ProductUnit::where('product_id', $id)->delete(); 
        $ProductHighLight = ProductHighLight::where('product_id', $id)->delete(); 
        $ProductTerm = ProductTerm::where('product_id', $id)->delete(); 
        $ProductStockStatus = ProductStockStatus::where('product_id', $id)->delete(); 
        


        $notification=array(
            'message' => 'Product Deleted Successfully !!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function delete_multi_image($id)
    {
        $p_image = ProductImage::where('id', $id)->first();

        if (file_exists($p_image->product_image)) {
            unlink($p_image->product_image);
        }
        if (file_exists($p_image->product_image_thumb)) {
            unlink($p_image->product_image_thumb);
        }
        
        ProductImage::where('id', $id)->delete();
        $notification=array(
            'message' => 'Product Image Deleted Successfully !!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }

}
