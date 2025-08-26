<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductStockStatus;
use App\Models\Post;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductUnit;
use App\Models\ProductSpecification;
use App\Models\ProductHighLight;
use App\Models\Page;
use App\Models\Siteinfo;
use App\Models\SiteSocialLink;
use App\Models\Rating;
use App\Models\Brand;
use App\Models\SiteSeo;
use App\Models\Service;
use App\Models\User;
use App\Models\SiteImage;
use App\Models\Booking;
use App\Models\Gallery;
use Session;
use Cart;
use Hash;

class WelcomeController extends Controller
{
    public function welcome()
    {

        return redirect('/admin/login');
        
        $banners = Banner::where('status', 1)->get();
        $main_categories = Category::where('parent_id', '==' , 0)->where('status', 1)->get();
        $sub_categories = Category::where('parent_id', '!=', 0)->where('status', 1)->get();
        $products = Product::where('status', 1)->orderBy('created_at', 'desc')->get();
        $latest_product = Product::orderBy('created_at', 'desc')->where('status', 1)->take(16)->get();
        $posts = Post::where('status', 1)->get();
        $user_id = Session::get('user_id');
        $allcategories = Category::where('status', 1)->get();
        $site_seo = SiteSeo::first();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        $galleries = Gallery::orderBy('created_at', 'desc')->where('status', 1)->get();

        $website_name = $this->website()['website_name'];
        $domain = $this->website()['domain'];

        return view('welcome', compact('banners', 'main_categories', 'sub_categories', 'products', 'posts', 'user_id', 'allcategories', 'site_seo', 'latest_product', 'site_info', 'domain', 'site_image', 'galleries'));
    }

    public function viewProductDetails(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $stock_status = ProductStockStatus::where('product_id', $product->id)->get();
        $productImages = ProductImage::where('product_id', $request->id)->get();
        $productBrands = ProductBrand::where('product_id', $request->id)->get();
        $ProductCategories = ProductCategory::where('product_id', $request->id)->get();
        $ProductSpecifications  = ProductSpecification::where('product_id', $request->id)->get();

        return view('frontend.product.ProductPopUp', compact('productImages', 'product', 'productBrands', 'ProductCategories', 'stock_status', 'ProductSpecifications'));
    }

    public function makeSlug($slug)
    {
        $user_id = Session::get('user_id');
        $category = Category::where('slug', $slug)->first();
        $siteinfo = Siteinfo::first();
        $social = SiteSocialLink::first();

        if($category){
            $products = Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->where('product_categories.category_id', $category->id)
                ->where('products.status', 1)
                ->select('products.*', 'product_categories.category_id', 'product_categories.product_id')
                ->paginate(30);

                $total_products = $products->count();


            return view('frontend.product.category_products', compact('products', 'category', 'total_products', 'user_id'));
        }

        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $productImages = ProductImage::where('product_id', $product->id)->get();
            $ProductBrands = ProductBrand::where('product_id', $product->id)->get();
            $stock_status = ProductStockStatus::where('product_id', $product->id)->get();
            $productSizes = ProductSize::where('product_id', $product->id)->get();
            $productColors = ProductColor::where('product_id', $product->id)->get();
            $productUnits = ProductUnit::where('product_id', $product->id)->get();
            $productBrands = ProductBrand::where('product_id', $product->id)->get();
            $ProductCategories = ProductCategory::where('product_id', $product->id)->get();
            $ProductSpecifications = ProductSpecification::where('product_id', $product->id)->get();
            $ProductHighLights = ProductHighLight::where('product_id', $product->id)->get();
            $latest_product = Product::orderBy('created_at', 'desc')->where('status', 1)->take(15)->get();

            $ratings = Rating::where('product_id', $product->id)->get();
            $rating_count = Rating::where('product_id', $product->id)->count();

            $TotalRating = Rating::where('product_id', $product->id)->sum('rate');


            $AverageRating = 0;
            if ($TotalRating > 0) {
                $AverageRating = $TotalRating/$rating_count;
            }

            $fivestar = Rating::where('product_id', $product->id)->where('rate', 5)->count();
            $fourstar = Rating::where('product_id', $product->id)->where('rate', 4)->count();
            $threestar = Rating::where('product_id', $product->id)->where('rate', 3)->count();
            $twostar = Rating::where('product_id', $product->id)->where('rate', 2)->count();
            $onestar = Rating::where('product_id', $product->id)->where('rate', 1)->count();

            foreach ($ProductCategories as $key => $category) {
                $relatedProducts = Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                              ->select('products.*', 'product_categories.category_id')
                              ->where('product_categories.category_id', 'LIKE', '%'.$category->category_id.'%')
                              ->where('products.status', 1)
                              ->get();
            }

            $website_name = $this->website()['website_name'];
            $domain = $this->website()['domain'];
            $site_info = Siteinfo::first();
            $site_seo = SiteSeo::first();

            return view('frontend.product.product_details', compact('product', 'productImages', 'ProductBrands', 'stock_status', 'productColors', 'productUnits', 'productSizes', 'productBrands', 'ProductCategories', 'ProductSpecifications', 'user_id', 'relatedProducts', 'siteinfo', 'ratings', 'rating_count', 'AverageRating', 'fivestar', 'fourstar', 'threestar', 'twostar', 'onestar', 'ProductHighLights', 'latest_product', 'domain', 'site_info', 'site_seo'));
        }

        $post = Post::where('slug', $slug)->first();
        if($post){
            $site_info = Siteinfo::first();
            return view('frontend.post.post_details', compact('post', 'siteinfo', 'social', 'site_info'));
        }

        $page = Page::where('slug', $slug)->first();
        if($page){
            return view('frontend.page.page_details', compact('page'));
        }

        return view('frontend.page.four_zeo_four');

    }


    public function sitemap(Request $r)
    {
       
        $website_name = $this->website()['website_name'];
        $website = $this->website()['domain'];

        $categories = Category::orderBy('id','desc')->where('status', 1)->get();
        $banners = Banner::orderBy('id','desc')->where('status', 1)->get();
        $brands = Brand::orderBy('id','desc')->where('status', 1)->get();
        $posts = Post::orderBy('id','desc')->where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        $pages = Page::where('status', 1)->get();

        return response()->view('sitemap', [
            'categories' => $categories,
            'posts' => $posts,
            'products' => $products,
            'website' => $website,
            'brands' => $brands,
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
      

    }  

    public function feed()
    {
        $website_name = $this->website()['website_name'];
        $website = $this->website()['domain'];
        $categories = Category::orderBy('id','desc')->where('status', 1)->get();
        $banners = Banner::orderBy('id','desc')->where('status', 1)->get();
        $posts = Post::orderBy('id','desc')->where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        $pages = Page::where('status', 1)->get();
        
        return response()->view('rss', [
            'categories' => $categories,
            'posts' => $posts,
            'website' => $website,
            'website_name' => $website_name,
            'products' => $products,
            'pages' => $pages,
        ])->header('Content-Type', 'application/xml');

    }

    public function robots()
    {
        return response(view('robots'))->header('Content-Type', 'text/plain');
    }

    public function get_all_category(Request $request)
    {
        $categories = Category::where('status', 1)->get();
        return view('frontend.layouts.get_all_category', compact('categories'));
    }

    public function get_all_cart_item(Request $request)
    {
        $contents = Cart::content();
        $total_item = Cart::content()->count();
        $sub_total = Cart::subtotal();
        $siteInfo = Siteinfo::first();
        return view('frontend.layouts.get_all_cart_item', compact('contents', 'total_item', 'sub_total', 'siteInfo'));
    }

    public function load_more_product(Request $request)
    {
        $user_id = Session::get('user_id');
        $products = Product::where('id', '>' , $request->id )->where('status', 1)->limit(10)->get();
        return view('frontend.product.load_more_product', compact('products', 'user_id'));
    }
    
    public function blog(){
        $user_id = Session::get('user_id');
        $posts = Post::where('status', 1)->get();
        $site_seo = SiteSeo::first();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        return view('frontend.page.blogs', compact('posts', 'user_id', 'site_seo', 'site_info', 'site_image'));
    }

    public function menus()
    {
        $categories = Category::where('status', 1)->get();
        $site_seo = SiteSeo::first();
        $site_image = SiteImage::first();

        return view('frontend.page.menus', compact('categories', 'site_seo', 'site_image'));
    }

    public function gallery()
    {
        $categories = Category::where('status', 1)->get();
        $site_seo = SiteSeo::first();
        $products = Product::where('status', 1)->get();
        $site_image = SiteImage::first();
        $galleries = Gallery::orderBy('created_at', 'desc')->where('status', 1)->get();
        return view('frontend.page.gallery', compact('categories', 'site_seo', 'products', 'site_image', 'galleries'));
    }

    public function facilities()
    {
        $categories = Category::where('status', 1)->get();
        $site_seo = SiteSeo::first();
        $services = Service::where('status', 1)->get();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        return view('frontend.page.facilities', compact('categories', 'site_seo', 'services', 'site_info', 'site_image'));
    }

    public function reservation()
    {
        $categories = Category::where('status', 1)->get();
        $site_seo = SiteSeo::first();
        $services = Service::where('status', 1)->get();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        return view('frontend.page.reservation', compact('categories', 'site_seo', 'services', 'site_info', 'site_image'));
    }

    public function CategoryItems($slug)
    {
        $category = Category::where('slug', $slug)->first();
 

        
        
        $products = Product::join('product_categories', 'products.id', '=', 'product_categories.product_id')
                                ->where('product_categories.category_id', $category->id)
                                ->where('products.status', 1)
                                ->select('products.*', 'product_categories.category_id', 'product_categories.product_id')
                                ->get();
        
        
        
        $site_seo = SiteSeo::first();
        $services = Service::where('status', 1)->get();
        $site_info = Siteinfo::first();
        $site_image = SiteImage::first();
        return view('frontend.page.CategoryItems', compact('category', 'site_seo', 'services', 'site_info', 'site_image', 'products'));
    }

    public function submitBooking(Request $request)
    {

        $validatedData = $request->validate(
            [
                'booking_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'duration' => 'required',
                'people' => 'required',
                'full_name' => 'required',
                'email' => 'required',
                'telephone' => 'required',
            ]
        );

        $user_id = Session::get('user_id');
        
        $booking_date = $request->booking_date;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $duration = $request->duration;
        $people = $request->people;
        $full_name = $request->full_name;
        $email = $request->email;
        $telephone = $request->telephone;
        $address = $request->address;
        $opt_message = $request->opt_message;

        $user = User::where('email', $email)->first();

        if(!$user){
            $data = new User();
            $data->fname = $request->full_name;
            $data->lname = $request->lname ?? '';
            $data->email = $request->email;
            $data->phone = $request->telephone;
            $data->address = $request->address;
            $data->postcode = $request->postcode ?? '';
            $data->city = $city->name ?? '';
            $data->area = $area->name ?? '';
            $data->password = Hash::make('123456');
            $data->save();
            Session::put('user_id', $data->id);
        }else{
            Session::put('user_id', $user->id);
        }

        $user_id = Session::get('user_id');

        $data = new Booking(); 
        $data->user_id = $user_id ?? $user->id;
        $data->booking_date = $booking_date;
        $data->start_time = $start_time;
        $data->end_time = $end_time;
        $data->duration = $duration;
        $data->people = $people;
        $data->full_name = $full_name;
        $data->email = $email;
        $data->telephone = $telephone;
        $data->address = $address;
        $data->opt_message = $opt_message;
        $data->status = 0;
        $data->save();

        return view('frontend.cart.thankyou');

        // session()->flash('notif', "Booking Successful !! ");
        // return redirect()->back();

    }

    public function website(){
        $domain = 'https://thaiparkrestaurent.com/';
        $website_name = 'Thi Park Resturant';
        return [
            'domain' => $domain,
            'website_name' => $website_name,
        ];
    }




}
