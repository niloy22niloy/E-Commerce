<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductThumb;
use App\Models\Color;
use App\Models\Sizes;
use App\Models\Inventory;
use Str;
use Image;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    // function add_product(){
    //    $categories= Category::all();
    //    $subcategories= SubCategory::all();
    //     return view('admin.product.add_product',[
    //         'categories'=>$categories,
    //         'subcategories'=>$subcategories,
            
    //     ]);
    // }
    // function getSubcategory(Request $request){
    //     $str='option value="">---SELECT SUBCATEGORY----</option>';
    //    $subcategories= SubCategory::where('category_id',$request->category_id)->get();
    //    foreach($subcategories as $subcategory)
    //    {
    //     $str .='option value="'.$subcategory->id.'">'.$subcategory->subcategory_name .'</option>';
       
    //    }
    //    echo $str;
       
    // }
    function add_products(){
        $categories= Category::all();
        $subcategories= SubCategory::all();

       return view('admin.product.add_products',[
             'categories'=>$categories, 
             'subcategories'=>$subcategories,
       ]);
    }
    function getSubcategories(Request $request){
        $str = '<option value="">---Select Sub category----</option>';
       $subcategories = SubCategory::where('category_id', $request->category_id)->get();
       foreach($subcategories as $subcategory){
        $str .='<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';

       }
       echo $str;
       
    }
    function product_store(Request $request){
        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'price'=>$request->price,
            'discount'=>$request->discount,
            'after_discount'=>$request->price-($request->price * $request->discount)/100,
            'brand'=>$request->brand,
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'slug'=>str_replace(' ','-',Str::lower($request->product_name)).'-'.rand(100000,900000),
            'created_at'=>Carbon::now(),
           
        ]);
        $uploaded_file=$request->preview;
        $extension=$uploaded_file->getClientOriginalExtension();
        $file_name= str_replace(' ','-',Str::lower($request->product_name)).'-'.rand(1000,9000). '.'.$extension;
        Image::make($uploaded_file)->resize(623,800)->save(public_path('uploads/product/preview/'.$file_name));
        
        Product::find($product_id)->update([
             'preview'=>$file_name,
        ]);
        
        //  echo $request->price - ($request->price * $request->discount)/100; 
        // echo str_replace(' ','-',Str::lower($request->product_name)).'-'.rand(100000,900000);
        $uploaded_thumbnails=$request->thumbnails;
        foreach($uploaded_thumbnails as $thumbnail){
            $thumb_extension = $thumbnail->getClientOriginalExtension();
            $thumb_name = str_replace(' ','-',Str::lower($request->product_name)).'-'.rand(1000,9000). '.'.$thumb_extension;
            Image::make($thumbnail)->resize(623,800)->save(public_path('uploads/product/thumbnail/'.$thumb_name));
            ProductThumb::insert([
                'product_id'=>$product_id,
              'thumbnail'=>$thumb_name,
            ]);
        }
        return back();
    }
   function product_list(){
    $products=Product::all();
    return view('admin.product.product_list',[
        'products'=>$products,
    ]);
   }
   function edit_product_list($id){
      $product_edit=Product::find($id);
      return view('admin/product/product_edit',[
        'product_edit'=>$product_edit,
      ]);
   }
  
   function product_edit($product_id){
    return view('admin.product.product_edit');
   }
   function add_inventory($product_id){
    $sizes=Sizes::all();
    $colors=Color::all();
    $product_info=Product::find($product_id);
    $inventory=Inventory::where('product_id',$product_id)->get();
    return view('admin.product.inventory',[
             'product_info'=>$product_info,
             'colors'=>$colors,
             'sizes'=>$sizes,
             'inventory'=>$inventory,
    ]);
   }

   function inventory_store(Request $request){
    if(Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
        Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increament('quantity',$request->quantity);
        return back();
    }else{
        Inventory::insert([
            'product_id'=>$request->product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
           ]);
           return back();
    }
   
    }

   function add_variation(){
    $sizes=Sizes::all();
    $colors=Color::all();
    return view('admin.product.variation',[
                'colors'=>$colors, 
                'sizes'=>$sizes,
]);
   }
   function add_color(Request $request){
    Color::insert([
        'color_name'=>$request->color_name,
        'color_code'=>$request->color_code,

    ]);
    return back();
   }
   function add_size(Request $request){
    
    Sizes::insert([
        'size_name'=>$request->size_name,
    ]);
    return back();
   }

  function product_delete($product_id){
    
    $preview_image=Product::where('id',$product_id)->get();
    $delete_from=public_path('uploads/product/preview/'.$preview_image->first()->preview);
    unlink($delete_from);
    Product::find($product_id)->delete();
    
    $thumbs=ProductThumb::where('product_id',$product_id)->get();
    foreach($thumbs as $thumb){
        $delete_thumb_from=public_path('uploads/product/thumbnail/'.$thumb->thumbnail);
        unlink($delete_thumb_from);
        ProductThumb::find($thumb->id)->delete();
        

    }
    $inventories=Inventory::where('product_id',$product_id)->get();
    foreach($inventories as $inventory){
        Inventory::find($inventory->id)->delete();
    }
    return back(); 
 
}
}