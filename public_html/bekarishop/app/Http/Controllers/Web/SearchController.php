<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $category_id = $request->category_id;
        $product_name = $request->product_name;
        $user_id = Session::get('user_id');

        if($category_id == 0){
            $products = Product::where('products.name', 'LIKE', '%'.$request->product_name.'%')
                          ->where('products.status', 1)
                          ->paginate(20);

          $products_count = Product::where('products.name', 'LIKE', '%'.$request->product_name.'%')
                          ->where('products.status', 1)
                          ->count();
        }else{
            $products = Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                          ->select('products.*', 'product_categories.category_id')
                          ->where('product_categories.category_id', 'LIKE', '%'.$request->category_id.'%')
                          ->where('products.name', 'LIKE', '%'.$request->product_name.'%')
                          ->where('products.status', 1)
                          ->paginate(20);

            $products_count = Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                          ->select('products.*', 'product_categories.category_id')
                          ->where('product_categories.category_id', 'LIKE', '%'.$request->category_id.'%')
                          ->where('products.name', 'LIKE', '%'.$request->product_name.'%')
                          ->where('products.status', 1)
                          ->count();

        }




        return view('frontend.product.search_products', compact('category_id', 'product_name', 'products', 'products_count', 'user_id', 'product_name'));
    }
}
