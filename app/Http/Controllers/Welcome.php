<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductThumb;
use App\Models\Inventory;
use App\Models\Sizes;
use Illuminate\Http\Request;

class Welcome extends Controller
{
    function welcome(){
        $categories=Category::all();
        $products = Product::latest()->take(8)->get();
        $featured_product=Product::latest()->take(4)->get();
        return view('fontend.index',[
            'categories'=>$categories,
            'products'=>$products,
            'featured_product'=>$featured_product,
        ]);
    }
    function about(){
        return view('about');
    }
    function service(){
        return view('service');
    }
    function information(){
        return view('information');


    }
    function master(){
        return view('fontend.master');
    }
    function product_details($slug){
        $product_info=Product::where('slug',$slug)->get();
        //$thumbnails=ProductThumb::where('product_id',$product_info->first()->id)->get();
        $thumbnails=ProductThumb::where('product_id',$product_info->first()->id)->get();
        $related_products=Product::where('category_id',$product_info->first()->category_id)->where('id','!=',$product_info->first()->id)->get();
        $available_colors = Inventory::where('product_id',$product_info->first()->id)->groupBy('color_id')->selectRaw('count(*) as total,color_id')->get();
        $available_size = Inventory::where('product_id',$product_info->first()->id)->first()->size_id;
        
        $sizes= Sizes::all();

      
        return view('fontend.details',[
            'product_info'=>$product_info,
            'thumbnails'=>$thumbnails,
            'related_products'=>$related_products,
            'available_colors'=>$available_colors,
            'sizes'=>$sizes,
            'available_size'=>$available_size,
        ]);
    }
    function getSize(Request $request){
        $sizes=Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str =  '';
        foreach($sizes as $size){
           $str .=   '<div class="form-check size-option form-option form-check-inline mb-2">
           <input class="form-check-input" type="radio" value="'.$size->rel_to_size->id.'" name="size_id" id="size'.$size->rel_to_size->id.'" >
           <label class="form-option-label" for="size'.$size->rel_to_size->id.'">'.$size->rel_to_size->size_name.'</label>
       </div>';
        }
        echo $str;


    }
    function customer_register_login(){
        return view('fontend.login');
    }
}
