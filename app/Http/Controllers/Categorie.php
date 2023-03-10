<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Str;

class Categorie extends Controller
{
    public function categorie(){
        $categories= Category::all();
        //Tashed Show
        $trashed= Category::onlyTrashed()->get();
        return view('categorie',[
            'categories'=>$categories,
            'trashed'=>$trashed,
        ]);

    }
   function add_categorie(Request $request){
    $request->validate([
        'category_name'=>'required|unique:categories',
    ]);
    
    //insert data by the id
    $category_id=Category::insertGetId([
         'category_name'=>$request->category_name,
         'added_by'=>Auth::id(),
         'created_at'=>Carbon::now(),
        
         
    ]);


    //image insert with random file name....
    $category_image=$request->category_image;
    $extension=$category_image->getClientOriginalExtension();
    $after_replace=str_replace(' ','-',$request->category_name);
    $file_name= Str::lower($after_replace). '-'.rand(100000,199999).'.'.$extension;
    Image::make($category_image)->resize(300,200)->save(public_path('uploads/category/'.$file_name));
    Category::find($category_id)->update([
        'category_image'=>$file_name,
    ]);
    return back();

    
   
    
   }
   function category_delete($category_id){
    Category::find($category_id)->delete();
    return back();
   }

   //Category Restore
   function category_restore($categoryRestore_id){
    Category::onlyTrashed()->find($categoryRestore_id)->restore();
    return back();
   }

    //Permanent Delete from category list
   function fixed_delete($fixeddelete){
    $category_fix_delete=Category::find($fixeddelete)->forceDelete();
    return redirect()->back()->with('delete', 'Permanent Delete Has Successfully Worked!');

   }
   //Permanent Delete from soft/trashed delete
   function permanent_delete($categoryRestore_id){
    $category_image=Category::onlyTrashed()->where('id',$categoryRestore_id)->first()->category_image;
    $delete_form=public_path('uploads/category/'.$category_image);
    unlink($delete_form);
    Category::onlyTrashed()->find($categoryRestore_id)->forceDelete();
    return redirect()->back()->with('message', 'Permanent Delete Has Successfully Worked!');

   }
   public function caregory_edit($category_id){
    $category_info=Category::find($category_id);
       return view('category_edit',compact('category_info'));
   }

   function caregory_update(Request $request){
       if($request->category_image == ""){
        //update name//
        Category::find($request->category_id)->update([
            'category_name'=>$request->category_name,
            'added_by'=>Auth::id(),
            'updated_at'=>Carbon::now(),

        ]);
        return back();
       }
       else{
        //delete previous image::
         $category_image_del= Category::Where('id',$request->category_id)->first()->category_image;
         $delete_from = public_path('uploads/category/'.$category_image_del);
         unlink($delete_from);
         
        //updateimage
        $uploaded_img=$request->category_image;
        $extension = $uploaded_img->getClientOriginalExtension();
        $file_name=  Str::lower($request->category_name). '-'.rand(100000,199999).'.'.$extension;

        Image::make($uploaded_img)->resize(300,200)->save(public_path('uploads/category/'.$file_name));
        Category::find($request->category_id)->update([
         'category_name'=>$request->category_name,
         'category_image'=>$file_name,
         'added_by'=>Auth::id(),
         'updated_at'=>Carbon::now(),
        ]);
        return back();


   }
       
    }
}
     
    

