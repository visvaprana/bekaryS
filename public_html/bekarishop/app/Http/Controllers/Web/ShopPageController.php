<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSeo;
use App\Models\SiteImage;
use Session;

class ShopPageController extends Controller
{
    public function shop(Request $request)
    {
        $user_id = Session::get('user_id');
        $products = Product::where('status', 1)->orderBy('created_at', 'desc')->paginate(20);

        $total_products = $products->count();
        $categories = Category::where('status', 1)->get();
        $site_image = SiteImage::first();
        return view('frontend.page.shop_page', compact('categories', 'products', 'total_products', 'user_id', 'site_image'));
    }

    public function filter(Request $request)
    {
        $user_id = Session::get('user_id');
        $price = $request->price;
        $colors = $request->color;
        $sizes = $request->size;


        foreach ($colors as $key => $value) {

            $products = Product::join('product_colors', 'products.id', '=', 'product_colors.product_id')
                ->join('product_sizes', 'products.id', '=', 'product_sizes.product_id')
                ->where('product_colors.color_id', $value)
                ->where('product_sizes.size_id', $sizes[$key])
                ->where('products.status', 1)
                ->select('products.*', 'product_colors.color_id', 'product_colors.product_id', 'product_sizes.size_id', 'product_sizes.product_id')
                ->get();

            $total_products = $products->count();
        }

        return view('frontend.page.filter_shop_page', compact('products', 'total_products', 'user_id'));

    }

    public function filter_by_price(Request $request)
    {
        $user_id = Session::get('user_id');
        $query = Product::orderBy('created_at','desc');

        if($request->min_price && $request->max_price){
            $query = $query->where('sell_price','>=',$request->min_price);
            $query = $query->where('sell_price','<=',$request->max_price);
        }
        $products = $query->paginate(20);
        return view('frontend.product.filter_by_price', compact('products', 'user_id'));
    }
    
    public function latest_product(){
        $user_id = Session::get('user_id');
        $products = Product::orderBy('created_at', 'desc')->where('status', 1)->paginate(20);
        $total_products = $products->count();
        
        return view('frontend.product.latest_product', compact( 'user_id', 'products', 'total_products'));
    }    
    
}
