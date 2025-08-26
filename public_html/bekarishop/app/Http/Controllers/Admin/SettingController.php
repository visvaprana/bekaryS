<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\Request;

use App\Models\Siteinfo;
use App\Models\SiteSocialLink;
use App\Models\SiteSeo;
use Str;
use Image;

class SettingController extends Controller
{
    public function setting(){
        $imge = SiteImage::first();
        $site_info = Siteinfo::first();
        $social_link = SiteSocialLink::first();
        $seo = SiteSeo::first();
        $site_image = SiteImage::first();
        return view('admin.setting.site_setting',compact('imge', 'site_info', 'social_link', 'seo', 'site_image'));
    }
    public function save_logo(Request $request){

        $validated = $request->validate([
            'logo' => 'mimetypes:text/plain,image/png,image/jpeg,image/jpg, image/webp',
        ]);

        $logo = SiteImage::find($request->img_id);
        if($logo){
            $data = SiteImage::find($request->img_id);
            
            
            
            if($request->hasFile('logo')) {
                $image = $request->logo;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $logo_img = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->save($logo_img);
                $data->logo = asset($logo_img);
                // Image::make($logo_img)->resize(180, 55)->save();
            }
            
            
            
            if($request->hasFile('logo_black')) {
                $image = $request->logo_black;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $logo_img = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->save($logo_img);
                $data->logo_black = asset($logo_img);

            }
            
            
            
            
            $data->save();
        }else{
            $data =new SiteImage();
            
            
            
            if($request->hasFile('logo')) {
                $image = $request->logo;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $logo_img = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->save($logo_img);
                $data->logo = asset($logo_img);
                // Image::make($logo_img)->resize(180, 55)->save();
            }
            
            
            if($request->hasFile('logo_black')) {
                $image = $request->logo_black;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $logo_img = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->save($logo_img);
                $data->logo_black = asset($logo_img);
                // Image::make($logo_img)->resize(180, 55)->save();
            }
            
            
            
            $data->save();
        }
        
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function save_favicon(Request $request){
        $favicon = SiteImage::find($request->fav_id);
        if($favicon){
            $fav_data = SiteImage::find($request->fav_id);
            if($request->hasFile('fav_icon')) {
                $image = $request->fav_icon;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $fav_icon = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->resize(32, 32)->save($fav_icon);
                $fav_data->favicon = asset($fav_icon);
            }
            $fav_data->save();
        }else{
            $fav_data = new SiteImage();
            if($request->hasFile('fav_icon')) {
                $image = $request->fav_icon;
                $filename = $image->getClientOriginalName();
                $filename = preg_replace('/\s+/', '-', $filename);
                $folder = 'uploads/'.date('Y').'/'.date('m');
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $fav_icon = $folder.'/'. time() . '-' . $filename;
                Image::make($image)->resize(32, 32)->save($fav_icon);
                $fav_data->favicon = asset($fav_icon);
            }
            $fav_data->save();
        }
        
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function save_site_info(Request $request, $id)
    {
        $data = Siteinfo::find($id);
        $data->site_name = $request->site_name;
        $data->phone = $request->phone;
        $data->site_owner_number = $request->site_owner_number;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->shipping_charge = $request->shipping_charge;
        $data->tax = $request->tax;
        $data->subscribe_title = $request->subscribe_title;
        $data->opening_hours = $request->opening_hours;
        $data->resturant_close = $request->resturant_close;
        $data->location_api = $request->location_api;
        $data->footer_description = $request->footer_description;

        $subscribe_image = $request->file('subscribe_image');
        if($subscribe_image)
        {
            $image_name= $subscribe_image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $subscribe_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(3200, 800)->save();
            if($success)
            {
                $old_subscribe_image = $request->old_subscribe_image;
                if (file_exists($old_subscribe_image)) {
                    unlink($request->old_subscribe_image);
                }
                
                $data->subscribe_image = $image_url;
            }
        }


        $welcome_resturant_image = $request->file('welcome_resturant_image');
        if($welcome_resturant_image)
        {
            $image_name= $welcome_resturant_image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $welcome_resturant_image->move($upload_path, $image_full_name);
            // $img = Image::make($image_url)->resize(3200, 800)->save();
            if($success)
            {
                $old_welcome_resturant_image = $request->old_welcome_resturant_image;
                if (file_exists($old_welcome_resturant_image)) {
                    unlink($request->old_welcome_resturant_image);
                }
                
                $data->welcome_resturant_image = $image_url;
            }
        }



        $data->welcome_resturant_description = $request->welcome_resturant_description;
        $data->catering_title = $request->catering_title;
        $data->google_anlytics_code = $request->google_anlytics_code;
        $data->robots_txt = $request->robots_txt;

        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function save_social_link(Request $request, $id)
    {
        $data = SiteSocialLink::find($id);
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->linkedin = $request->linkedin;
        $data->instagram = $request->instagram;
        $data->youtube = $request->youtube;
        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function save_seo(Request $request, $id)
    {
        $data = SiteSeo::find($id);
        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;
        $data->robots = $request->robots;
        $data->canonical = $request->canonical;
        $image = $request->file('meta_image');
        if($image)
        {
            $image_name= $image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/uploads/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
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
    public function save_image(Request $request, $id)
    {
        $data = SiteImage::find($id);
        $menu_home_image = $request->file('menu_home_image');
        if($menu_home_image)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $menu_home_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(501, 334)->save();
            if($success)
            {
                $old_menu_home_image = $request->old_menu_home_image;
                if (file_exists($old_menu_home_image)) {
                    unlink($request->old_menu_home_image);
                }
                $data->menu_home_image = $image_url;
            }
        }

        $reserv_home_image = $request->file('reserv_home_image');
        if($reserv_home_image)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $reserv_home_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(501, 334)->save();
            if($success)
            {
                $old_reserv_home_image = $request->old_reserv_home_image;
                if (file_exists($old_reserv_home_image)) {
                    unlink($request->old_reserv_home_image);
                }
                $data->reserv_home_image = $image_url;
            }
        }

        $gallery_home_image = $request->file('gallery_home_image');
        if($gallery_home_image)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $gallery_home_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(501, 334)->save();
            if($success)
            {
                $old_gallery_home_image = $request->old_gallery_home_image;
                if (file_exists($old_gallery_home_image)) {
                    unlink($request->old_gallery_home_image);
                }
                $data->gallery_home_image = $image_url;
            }
        }


        $reserv_banner_home_image = $request->file('reserv_banner_home_image');
        if($reserv_banner_home_image)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $reserv_banner_home_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1200, 600)->save();
            if($success)
            {
                $old_reserv_banner_home_image = $request->old_reserv_banner_home_image;
                if (file_exists($old_reserv_banner_home_image)) {
                    unlink($request->old_reserv_banner_home_image);
                }
                $data->reserv_banner_home_image = $image_url;
            }
        }

        $contact_banner_home_image = $request->file('contact_banner_home_image');
        if($contact_banner_home_image)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $contact_banner_home_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1600, 1067)->save();
            if($success)
            {
                $old_contact_banner_home_image = $request->old_contact_banner_home_image;
                if (file_exists($old_contact_banner_home_image)) {
                    unlink($request->old_contact_banner_home_image);
                }
                $data->contact_banner_home_image = $image_url;
            }
        }

        $reserv_profile_home_image = $request->file('reserv_profile_home_image');
        if($reserv_profile_home_image)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $reserv_profile_home_image->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(420, 770)->save();
            if($success)
            {
                $old_reserv_profile_home_image = $request->old_reserv_profile_home_image;
                if (file_exists($old_reserv_profile_home_image)) {
                    unlink($request->old_reserv_profile_home_image);
                }
                $data->reserv_profile_home_image = $image_url;
            }
        }

        $menu_banner = $request->file('menu_banner');
        if($menu_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $menu_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_menu_banner = $request->old_menu_banner;
                if (file_exists($old_menu_banner)) {
                    unlink($request->old_menu_banner);
                }
                $data->menu_banner = $image_url;
            }
        }


        $shop_banner = $request->file('shop_banner');
        if($shop_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $shop_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_shop_banner = $request->old_shop_banner;
                if (file_exists($old_shop_banner)) {
                    unlink($request->old_shop_banner);
                }
                $data->shop_banner = $image_url;
            }
        }

        $gallery_banner = $request->file('gallery_banner');
        if($gallery_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $gallery_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_gallery_banner = $request->old_gallery_banner;
                if (file_exists($old_gallery_banner)) {
                    unlink($request->old_gallery_banner);
                }
                $data->gallery_banner = $image_url;
            }
        }

        $facility_banner = $request->file('facility_banner');
        if($facility_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $facility_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_facility_banner = $request->old_facility_banner;
                if (file_exists($old_facility_banner)) {
                    unlink($request->old_facility_banner);
                }
                $data->facility_banner = $image_url;
            }
        }

        $blog_banner = $request->file('blog_banner');
        if($blog_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $blog_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_blog_banner = $request->old_blog_banner;
                if (file_exists($old_blog_banner)) {
                    unlink($request->old_blog_banner);
                }
                $data->blog_banner = $image_url;
            }
        }

        $contact_banner = $request->file('contact_banner');
        if($contact_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $contact_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_contact_banner = $request->old_contact_banner;
                if (file_exists($old_contact_banner)) {
                    unlink($request->old_contact_banner);
                }
                $data->contact_banner = $image_url;
            }
        }

        $my_account_banner = $request->file('my_account_banner');
        if($my_account_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $my_account_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_my_account_banner = $request->old_my_account_banner;
                if (file_exists($old_my_account_banner)) {
                    unlink($request->old_my_account_banner);
                }
                $data->my_account_banner = $image_url;
            }
        }

        $login_banner = $request->file('login_banner');
        if($login_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $login_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_login_banner = $request->old_login_banner;
                if (file_exists($old_login_banner)) {
                    unlink($request->old_login_banner);
                }
                $data->login_banner = $image_url;
            }
        }

        $registration_banner = $request->file('registration_banner');
        if($registration_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $registration_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_registration_banner = $request->old_registration_banner;
                if (file_exists($old_registration_banner)) {
                    unlink($request->old_registration_banner);
                }
                $data->registration_banner = $image_url;
            }
        }

        $cart_banner = $request->file('cart_banner');
        if($cart_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $cart_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_cart_banner = $request->old_cart_banner;
                if (file_exists($old_cart_banner)) {
                    unlink($request->old_cart_banner);
                }
                $data->cart_banner = $image_url;
            }
        }

        $checkout_banner = $request->file('checkout_banner');
        if($checkout_banner)
        {
            $image_name= str::random(10);
            $image_full_name = $image_name.'.webp';
            $upload_path = 'images/site_images/';
            $image_url = $upload_path.$image_full_name;
            $success = $checkout_banner->move($upload_path, $image_full_name);
            $img = Image::make($image_url)->resize(1400, 788)->save();
            if($success)
            {
                $old_checkout_banner = $request->old_checkout_banner;
                if (file_exists($old_checkout_banner)) {
                    unlink($request->old_checkout_banner);
                }
                $data->checkout_banner = $image_url;
            }
        }




        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
