<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Country;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Exception;
use Twilio\Rest\Client;
class CheckoutController extends Controller
{
    function checkout(){
        $carts= Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $countries = Country::all();
        return view('fontend.checkout',[
           'carts'=>$carts, 
           'countries'=> $countries,
        ]);
    }
    function getCity(Request $request){
        $str = ' <option value="">-- Select City --</option>';
       $cities = City::where('country_id',$request->country_id)->get();
       foreach($cities as $city){
        $str .=' <option value="'.$city->id.'">'.$city->name.'</option>';
       }
       echo $str;
    }
    function order_store(Request $request){
        if($request->payment_method == 1){
            $order_id = '#'.'JETT'.'-'.rand(999999,100000);
        Order::insert([
              'order_id'=>$order_id,
              'customer_id'=>Auth::guard('customerlogin')->id(),
              'subtotal'=>$request->sub_total,
              'discount'=>$request->discount,
              'charge'=>$request->charge,
              'total'=>$request->sub_total + $request->charge,
              'payment_method'=>$request->payment_method,
              'created_at'=>Carbon::now(),
       ]);

       BillingDetails::insert([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('customerlogin')->id(),
                     'name'=>$request->name,
                     'email'=>$request->email,
                     'company'=>$request->company,
                     'phone'=>$request->phone,
                     'address'=>$request->address,
                      'zip'=>$request->zip,
                      'country_id'=>$request->country_id,
                      'city_id'=>$request->city_id,
                      'notes'=>$request->notes,
                      'created_at'=>Carbon::now(),


       ]);
       $carts=Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
      foreach($carts as $cart){
        OrderProduct::insert([
            'order_id'=>$order_id,
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'product_id'=>$cart->product_id,
            'price'=>$cart->rel_to_product->after_discount,
            'color_id'=>$cart->color_id,
            'size_id'=>$cart->size_id,
            'quantity'=>$cart->quantity,
            'created_at'=>Carbon::now(),
            
       ]);
        Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
      }
      Mail::to($request->email)->send(new InvoiceMail($order_id));
      
      $receiver_number = '+8801742362300';
       
      $message = 'Thanks for shopping';
     
          $account_sid = getenv("TWILIO_SID");
          $auth_token = getenv("TWILIO_TOKEN");
          $twilio_number = getenv("TWILIO_FROM");

          $client = new Client($account_sid, $auth_token);
          $client->messages->create("$receiver_number",[
              'from' => $twilio_number, 
              'body' => $message
          ]);
//       $account_sid = getenv("TWILIO_SID");
//       $auth_token =  getenv("TWILIO_TOKEN");
// // In production, these should be environment variables. E.g.:
// // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// // A Twilio number you own with SMS capabilities
// $twilio_number = "+15618165125";

// $client = new Client($account_sid, $auth_token);
// $client->messages->create(
//     // Where to send a text message (your cell phone?)
//    $a= $request->phone,
 
//     array(
//         'from' => $twilio_number,
//         'body' => 'I sent this message in under 10 minutes!'
//     )
// );

          
      Cart::where('customer_id',Auth::guard('customerlogin')->id())->delete();
      return redirect()->route('order.success')->withOrder($order_id);
        } else if($request->payment_method == 2){
            echo "SSL";
        }else{
                 echo "stripe";
        }
        
    }
    function order_success(){
      if(session('order')){
        $order_id = session('order');
        return view('fontend.order_success',[
          'order_id'=> $order_id,
        ]);
      }else{
       abort('404');
      }
        
    }
}
