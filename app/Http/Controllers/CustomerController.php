<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Session\Session;
use flash;
class CustomerController extends Controller
{
    function customer_profile(){
        return view('fontend.profile');
    }
    function customer_profile_update(Request $request){
    //   Customerlogin::find(Auth::guard('customerlogin')->id())->update([

    //   ]);
    if($request->password == ''){
               if($request->photo == ''){
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,


                      ]);  
                     
                      
                      return back()->with('error_mss',"updated without password and photo!!"); 
                 
                      
                      
               }else{

                if(Auth::guard('customerlogin')->user()->photo != null){
                    $delete_from = public_path('/uploads/customer/'.Auth::guard('customerlogin')->user()->photo);
                    unlink($delete_from);
                }
                $uploaded_img=$request->photo;
                $extension = $uploaded_img->getClientOriginalExtension();
               $file_name=  Auth::guard('customerlogin')->id(). '-'.rand(100000,199999).'.'.$extension;

                Image::make($uploaded_img)->resize(300,200)->save(public_path('uploads/customer/'.$file_name));
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                    'photo'=>$file_name,


                      ]); 
                      return back()->with('error_image',"updated without password !!"); 
                    
               }
    }else{
      if(Hash::check($request->old_password,Auth::guard('customerlogin')->user()->password )){
         if($request->photo == ''){
            
                Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'country'=>$request->country,
                    'address'=>$request->address,
                    'password'=>bcrypt($request->password)
    
    
                      ]);  
           
            
                      return back()->with('error_image',"updated without image !!"); 
               
           }
          else{

            if(Auth::guard('customerlogin')->user()->photo != null){
                $delete_from = public_path('/uploads/customer/'.Auth::guard('customerlogin')->user()->photo);
                unlink($delete_from);
            }
            $uploaded_img=$request->photo;
            $extension = $uploaded_img->getClientOriginalExtension();
           $file_name=  Auth::guard('customerlogin')->id(). '-'.rand(100000,199999).'.'.$extension;

          Image::make($uploaded_img)->resize(300,200)->save(public_path('uploads/customer/'.$file_name));
          
            Customerlogin::find(Auth::guard('customerlogin')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'country'=>$request->country,
                'address'=>$request->address,
                'photo'=>$file_name,
                'password'=>bcrypt($request->password),

                  ]);
                
                  
                }
                return back()-> with('message', 'Password Match And Successfully changed with image');
              }else{
                return back()-> with('message_fail', 'Password doesnot Match And Can not changed');
              }
                
           }
    }
   function customer_order(){
    $orders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
    return view('fontend.customer_order',[
        'orders'=>$orders,
    ]);
   }
}
    

