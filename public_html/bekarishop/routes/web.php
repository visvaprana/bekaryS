<?php

use App\Http\Controllers\Web\WelcomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\SearchController;
use App\Http\Controllers\Web\RatingController;
use App\Http\Controllers\Web\ShopPageController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\SocialLoginController;



use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ResturantController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemPackageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Page_categoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\MarqueeController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SiteUserController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\POSController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('config_cache', function(){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return "Config-Cache is cleared";
});



Route::get('/', [WelcomeController::class, 'welcome'])->name('/');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::get('login', [UserController::class, 'login_page'])->name('login');
Route::post('registration', [UserController::class, 'registration'])->name('registration');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('checkout_login', [UserController::class, 'checkout_login'])->name('checkout_login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('forgot-password', [UserController::class, 'forgot_password'])->name('forgot-password');
Route::post('verify', [UserController::class, 'verify'])->name('verify');
Route::get('verify-otp', [UserController::class, 'verify_otp'])->name('verify-otp');


Route::post('reset-password', [UserController::class, 'reset_password'])->name('reset-password');
Route::get('new-password/{user_id}', [UserController::class, 'new_password'])->name('new-password');


// Route::post('verify-account', [UserController::class, 'verify_account'])->name('verify-account');
Route::post('update-password', [UserController::class, 'update_password'])->name('update-password');

Route::get('account', [UserController::class, 'account'])->name('account');
Route::post('track-order', [UserController::class, 'track_order'])->name('track-order');
Route::post('update-profile', [UserController::class, 'update_profile'])->name('update-profile');
Route::get('wishlist', [UserController::class, 'wishlist'])->name('wishlist');
Route::delete('remove-from-wishlist/{id}', [UserController::class, 'remove_from_wishlist'])->name('remove-from-wishlist');
Route::post('subscription', [UserController::class, 'subscription'])->name('subscription');
Route::get('order-details/{id}', [UserController::class, 'order_details'])->name('order-details');


Route::get('cart-page', [ShopController::class, 'cart_page'])->name('cart-page');
Route::get('cart-destroy', [ShopController::class, 'cart_destroy'])->name('cart-destroy');

Route::get('update-cart', [ShopController::class, 'update_cart'])->name('update-cart');
Route::get('checkout', [ShopController::class, 'checkout'])->name('checkout');
Route::post('place-order', [ShopController::class, 'place_order'])->name('place-order');
Route::post('submit-coupon', [ShopController::class, 'submit_coupon'])->name('submit-coupon');


Route::post('search', [SearchController::class, 'search'])->name('search');
Route::post('submit-your-rate', [RatingController::class, 'submit_your_rate'])->name('submit-your-rate');


Route::get('sitemap.xml', [WelcomeController::class, 'sitemap'])->name('sitemap.xml');
Route::get('rss.xml', [WelcomeController::class, 'feed'])->name('rss.xml');
Route::get('robots.txt', [WelcomeController::class, 'robots'])->name('robots.txt');

Route::post('load-more-product', [WelcomeController::class, 'load_more_product'])->name('load-more-product');


Route::get('shop', [ShopPageController::class, 'shop'])->name('shop');
Route::get('latest-product', [ShopPageController::class, 'latest_product'])->name('latest-product');
Route::get('blog', [WelcomeController::class, 'blog'])->name('blog');
Route::post('filter', [ShopPageController::class, 'filter'])->name('filter');
Route::post('filter-by-price', [ShopPageController::class, 'filter_by_price'])->name('filter-by-price');


Route::get('contact', [ContactController::class, 'contact'])->name('contact');
Route::post('send-message', [ContactController::class, 'send_message'])->name('send-message');


//Socialite
Route::get('auth/facebook', [SocialLoginController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialLoginController::class, 'loginWithFacebook']);

Route::get('menus', [WelcomeController::class, 'menus'])->name('menus');
Route::get('facilities', [WelcomeController::class, 'facilities'])->name('facilities');
Route::get('gallery', [WelcomeController::class, 'gallery'])->name('gallery');
Route::get('reservation', [WelcomeController::class, 'reservation'])->name('reservation');
Route::post('submit-booking', [WelcomeController::class, 'submitBooking'])->name('submit-booking');

Route::get('/{slug}', [WelcomeController::class, 'makeSlug'])->name('/');

Route::get('items/{slug}', [WelcomeController::class, 'CategoryItems'])->name('items');



Route::post('view-product-details', [WelcomeController::class, 'viewProductDetails'])->name('view-product-details');


Route::post('add-to-cart/{id}',  [ShopController::class, 'add_to_cart'])->name('add-to-cart');
Route::post('add-to-wishlist/{id}',  [ShopController::class, 'add_to_wishlist'])->name('add-to-wishlist');
Route::delete('remove-from-cart/{rowId}', [ShopController::class, 'remove_from_cart'])->name('remove-from-cart');
Route::get('increase-cart/{rowId}', [ShopController::class, 'increase_cart'])->name('increase-cart');
Route::get('decrease-cart/{rowId}', [ShopController::class, 'decrease_cart'])->name('decrease-cart');


Route::post('get-payment-method-data/{id}', [ShopController::class, 'get_payment_method_data'])->name('get-payment-method-data');
Route::post('get-all-category', [WelcomeController::class, 'get_all_category'])->name('get-all-category');
Route::post('get-all-cart-item', [WelcomeController::class, 'get_all_cart_item'])->name('get-all-cart-item');
Route::post('get-area', [ShopController::class, 'get_area'])->name('get-area');
Route::post('get-shipping-area', [ShopController::class, 'get_shipping_area'])->name('get-shipping-area');
Route::post('get-shipping-charge', [ShopController::class, 'get_shipping_charge'])->name('get-shipping-charge');
Route::post('get-urgent-charge', [ShopController::class, 'get_urgent_charge'])->name('get-urgent-charge');




Route::prefix('admin')->group(function (){
    Route::get('/login', [AdminController::class, 'login']);
    Route::get('/dashboard', [AdminController::class, 'home'])->name('dashboard');
    Route::post('/login', [AdminController::class, 'admin_login'])->name('admin-login');
    Route::get('/logout', [AdminController::class, 'admin_logout'])->name('admin-logout');
    Route::get('/forget-password', 'AdminController@forget_password')->name('forget-password');
    Route::group(['middleware' => ['AdminUserMiddleWare']], function () {


        Route::get('/config_cache', [AdminController::class, 'config_cache'])->name('config_cache');

        Route::get('/dashboard', [AdminController::class, 'home'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile', [AdminController::class, 'save_profile'])->name('save-profile');
        Route::get('/change-password', [AdminController::class, 'change_password'])->name('change-password');
        Route::post('/save-password', [AdminController::class, 'save_password'])->name('save-password');

        //website setting
        Route::get('/site-setting', [SettingController::class, 'setting'])->name('site-setting');
        Route::post('/save-logo', [SettingController::class, 'save_logo'])->name('save-logo');
        Route::post('/save-favicon', [SettingController::class, 'save_favicon'])->name('save-favicon');
        Route::post('/save-site-info/{id}', [SettingController::class, 'save_site_info'])->name('save-site-info');
        Route::post('/save-social-link/{id}', [SettingController::class, 'save_social_link'])->name('save-social-link');
        Route::post('/save-seo/{id}', [SettingController::class, 'save_seo'])->name('save-seo');
        Route::post('/save-image/{id}', [SettingController::class, 'save_image'])->name('save-image');


        //Order Controller
        Route::resource('order', OrderController::class);



        Route::get('pending-order', [OrderController::class, 'pending_order'])->name('admin/pending-order');
        Route::get('processing-order', [OrderController::class, 'processing_order'])->name('admin/processing-order');
        Route::get('on-the-way-order', [OrderController::class, 'on_the_way_order'])->name('admin/on-the-way-order');
        Route::get('/delivered-order', [OrderController::class, 'delivered_order'])->name('admin/delivered-order');
        Route::get('canceled-order', [OrderController::class, 'canceled_order'])->name('admin/canceled-order');




        Route::get('contact-request', [BookingController::class, 'contact_request'])->name('admin/contact-request');
        Route::get('delete-contact-request/{id}', [BookingController::class, 'delete_contact_request'])->name('admin/delete-contact-request');
        Route::get('edit-contact-request/{id}', [BookingController::class, 'edit_contact_request'])->name('admin/edit-contact-request');
        Route::post('update-contact-request/{id}', [BookingController::class, 'update_contact_request'])->name('admin/update-contact-request');


        Route::post('apply-coupon', [POSController::class, 'applyCoupon'])->name('admin.apply.coupon');



        Route::get('admin/invoice-print/{id}', [OrderController::class, 'invoice_print'])->name('admin/invoice-print');



        Route::post('admin/update-shipping-address/{id}', [OrderController::class, 'update_shipping_address'])->name('admin/update-shipping-address');
        Route::post('admin/update-order-summery/{id}', [OrderController::class, 'update_order_summery'])->name('admin/update-order-summery');
        Route::get('admin/filter-order', [OrderController::class, 'filter_order'])->name('admin/filter-order');

        Route::get('filter-by-category', [OrderController::class, 'filter_by_category'])->name('admin/filter-by-category');
        Route::get('filter-order-by-category', [OrderController::class, 'filter_order_by_category'])->name('admin/filter-order-by-category');
        
        Route::get('filter-by-user', [OrderController::class, 'filter_by_user'])->name('admin/filter-by-user');
        Route::get('filter-order-by-user', [OrderController::class, 'filter_order_by_user'])->name('admin/filter-order-by-user');



        Route::get('update_category_id', [OrderController::class, 'update_category_id'])->name('admin/update_category_id');


        Route::resource('booking', BookingController::class);

        //category
        Route::resource('category', CategoryController::class);
        //brand
        Route::resource('brand', BrandController::class);

        //country
        Route::resource('country', CountryController::class);
        Route::get('/country/active/{id}', [CountryController::class, 'active'])->name('active-country');
        Route::get('/country/inactive/{id}', [CountryController::class, 'inactive'])->name('inactive-country');
        //city
        Route::resource('city', CityController::class);
        //area
        Route::resource('area', AreaController::class);
        //resturant
        Route::resource('resturant', ResturantController::class);
        //item
        Route::resource('item', ItemController::class);
        //item_package
        Route::resource('item_package', ItemPackageController::class);
        //role
        Route::resource('role', RoleController::class);
        //subscription
        Route::resource('subscription', SubscriptionController::class);
        //post
        Route::resource('post', PostController::class);
        //coupon
        Route::resource('coupon', CouponController::class);
        //banner
        Route::resource('banner', BannerController::class);
        //partner
        Route::resource('partner', PartnerController::class);
        //attribute
        Route::resource('attribute', AttributeController::class);
        //attribute_value
        Route::resource('attribute_value', AttributeValueController::class);
        //product
        Route::resource('product', ProductController::class);
        Route::post('update-multi-image', [ProductController::class, 'update_multi_image'])->name('admin/update-multi-image');
        Route::get('delete-multi-image/{id}', [ProductController::class, 'delete_multi_image'])->name('admin/delete-multi-image');
        //color
        Route::resource('color', ColorController::class);
        //size
        Route::resource('size', SizeController::class);
        //unit
        Route::resource('unit', UnitController::class);
        //service
        Route::resource('service', ServiceController::class);

        //Page Controller
        Route::resource('page', PageController::class);

        //user Controller
        Route::resource('user', SiteUserController::class);

        //employee Controller
        Route::resource('employee', EmployeeController::class);

        //marquee Controller
        Route::resource('marquee', MarqueeController::class);

        //gallery Controller
        Route::resource('gallery', GalleryController::class);


        //pagecategory Controller
        Route::resource('pagecategory', Page_categoryController::class);


        //pos Controller
        Route::resource('pos', POSController::class);
        Route::post('add_to_cart',  [POSController::class, 'add_to_cart'])->name('admin/add_to_cart');
        Route::post('update-cart',  [POSController::class, 'update_cart'])->name('admin/update-cart');
        Route::get('remove_from_cart_admin/{rowId}', [POSController::class, 'remove_from_cart'])->name('admin/remove_from_cart_admin');

        Route::get('print_order_report', [POSController::class, 'print_order_report'])->name('admin/print_order_report');
        Route::get('print_order_report_category', [POSController::class, 'print_order_report_category'])->name('admin/print_order_report_category');
        Route::get('clear_cart', [POSController::class, 'clear_cart'])->name('admin/clear_cart');



        Route::post('add_new_user',  [POSController::class, 'add_new_user'])->name('admin/add_new_user');
        Route::get('submit_order_admin',  [POSController::class, 'submit_order_admin'])->name('admin/submit_order_admin');


        Route::get('invoice/{id}', [DeliveryController::class, 'pos_invoice'])->name('admin/invoice');
        Route::get('assign-delivery-man/{id}', [DeliveryController::class, 'assign_delivery_man'])->name('admin/assign-delivery-man');
        Route::post('assign_delivery_man_store', [DeliveryController::class, 'assign_delivery_man_store'])->name('admin/assign_delivery_man_store');









        //payment_method Controller
        Route::resource('payment_method', PaymentMethodController::class);

        Route::get('import-city', [CityController::class, 'import_city'])->name('admin/import-city');
        Route::post('import-city-file', [CityController::class, 'import_city_file'])->name('admin/import-city-file');

        Route::get('import-area', [AreaController::class, 'import_area'])->name('admin/import-area');
        Route::get('delete-all-area', [AreaController::class, 'delete_all_area'])->name('admin/delete-all-area');
        Route::post('import-area-file', [AreaController::class, 'import_area_file'])->name('admin/import-area-file');

        //Ajax Request
        Route::post('admin/get-city', [AreaController::class, 'get_city'])->name('admin/get-city');
        Route::post('admin/get-area', [AreaController::class, 'get_area'])->name('admin/get-area');
        Route::post('admin/get-item', [ItemPackageController::class, 'get_item'])->name('admin/get-item');
        Route::post('admin/get-products', [POSController::class, 'get_products'])->name('admin/get-products');
        Route::post('admin/get-products-by-name', [POSController::class, 'get_products_by_name'])->name('admin/get-products-by-name');


    });
});
