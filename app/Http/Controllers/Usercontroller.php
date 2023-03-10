<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    function users(){
        //select all users
        $users= User::all();
        //Select  users where id is not match with      
        $users= User::where('id', '!=', Auth::id())->get();
        //count all data
        $total_user=User::count();
        
        return view('admin.users.user' , compact('users','total_user'));
    }
    function delete($user_id){
        User::find($user_id)->delete();
        return back();
    }
    function Profile(){
        return view('admin.users.profile');
    }
    function name_update(Request $request){
       /*displaying name
        print_r($request->name);
       */
      
       //updating
        User::find(Auth::id())->update([
             'name'=>$request->name,
 
        ]);
        return back();
            
   
    }
    function pass_update(Request $request){
        //print_r($request->all());
        $request->validate([
                'old_password'=>'required',
                
                'password'=>Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
                'password'=>'required|confirmed',
                'password_confirmation'=>'required',
 
        ],[  
            
             'password.confirmed'=>'new pass r confirm pass same nah',
            
        ]);

        if(Hash::check($request->old_password, Auth::user()->password)){
           User::find(Auth::id())->update([
            'password'=>($request->password),
           ]);
           return back()->with('success','Password has been updated');
        }else{
            return back()->with('wrong_pass','old_password is not matched');
        }

    }
    public function updatePhoto(Request $request){
             $photo = $request->file('photo');
             $unique_name = hexdec(uniqid());
             $photo_extension = $photo->getClientOriginalExtension();
             $photo_extension_lower = strtolower($photo_extension);
             $uni_photo_extension = $unique_name. '.' .$photo_extension_lower;
             $upload_location = 'image/';
             $uni_photo_exteension_path = $upload_location.$uni_photo_extension;
             $photo->move($upload_location,$uni_photo_extension);
             $id=Auth::user()->id;
            User::where('id',$id)->update([
                'image' => $uni_photo_exteension_path
            ]);

            return redirect()->back()->with('success_image','photo upload successfully');
    }

    
    
}
