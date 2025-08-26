<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;
use Image;
use Hash;
use Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;


class AdminController extends Controller
{
    
    public function config_cache(){
   
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');

        
        $notification=array(
            'message' => 'Cache Cleared',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function clearLocalStorage()
    {
        return clearLocalStorage();
    }
    public function login(){
        return view('admin.auth.login');
    }
    public function home(){
        return view('admin.home');
    }
    public function admin_login(Request $request){
        $email = $request->email;
        $adminByEmail = Admin::where(['email'=>$email,'status'=>1])->first();
        
        if ($adminByEmail == null) {
            $notification=array(
                'message' => 'Email or Password is not Valid',
                'alert-type' => 'success'
            );
            return redirect()->back()->with('message', 'Email or Password is not Valid');
        } else {
            $existingPassword = $adminByEmail->password;
//    return $existingPassword;
            if (password_verify($request->password, $existingPassword)) {
                Session::put('adminId', $adminByEmail->id);
                Session::put('adminName', $adminByEmail->name);
                Session::put('adminEmail', $adminByEmail->email);
                Session::put('adminRole', $adminByEmail->role_id);
                return redirect('/admin/dashboard');
            } else {
                $notification=array(
                    'message' => 'Email or Password is not Valid',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
        }
    }
    public function admin_logout(){
        Session::forget('adminId');
        Session::forget('adminName');
        Session::forget('adminEmail');
        return redirect('/admin/login');
    }
    public function profile(){
        $id = Session::get('adminId');
        $user_by_id = Admin::where('id',$id)->first();
        return view('admin.auth.profile',compact('user_by_id'));
    }
    public function save_profile(Request $request){
            $id = Session::get('adminId');
            $data = Admin::where('id',$id)->first();
            $data->name=$request->name;
            $data->user_name=$request->username;
            $data->phone=$request->phone;
            $data->email=$request->email;
            $data->address=$request->address;
        if($request->hasFile('image')) {
            $image = $request->image;
            $filename = $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '-', $filename);
            $folder = 'uploads/'.date('Y').'/'.date('m');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $user_img = $folder.'/'. time() . '-' . $filename;
            Image::make($image)->resize(300, 300)->save($user_img);
            $data->image = secure_asset($user_img);
        }
        
        $data->save();
        $notification=array(
            'message' => 'Successfully Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }
    public function change_password(){
        return view('admin.auth.change_pass');
    }
    public function save_password(Request $request){
        $id = Session::get('adminId');
        if($request->old_password){
            
            $this->validate($request, [
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6'
            ]);
            $user = Admin::where('id',$id)->first();
            if (!(Hash::check($request->get('old_password'), $user->password))) {
                $notification=array(
                    'message' => 'Your current password does not matches with the password you provided. Please try again.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
                // The passwords matches
            }
            $user->password = bcrypt($request->password);
            $user->save();
            $notification=array(
                'message' => 'Password Successfully Changed',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
