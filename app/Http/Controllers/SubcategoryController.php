<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubcategoryController extends Controller
{
    function subcategory(){
        $subcategories=Subcategory::all();
        $categories=Category::all();
        return view('category.subcategory',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }
    function subcategory_store(Request $request){
        Subcategory::insert([
         'category_id'=>$request->category_id,
         'subcategory_name'=>$request->subcategory_name,
         'added_by'=>Auth::id(),
         'created_at'=>Carbon::now(),
         
        ]);
        return back();

    }
    // function getsubcategory(Request $request){
    //     $subcategories= Subcategory::where( 'category_id',$request->category_id)->get();
    //     $subcate='';
    //     foreach($subcategories as $sub){
    //         $subcate .= '<tr><td> '.$sub->subcategory_name.' </td></tr>' ;
    //         $subbb = '<input type=submit>' ;
    //     }
    //       echo $subcate;
         
    // }
}
